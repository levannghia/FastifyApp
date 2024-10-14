<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ConfirmOrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'delivery_partner_id' => 'nullable|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'delivery_location' => 'nullable|array',
            'pickup_location' => 'nullable|array',
            'delivery_person_location' => 'nullable|array',
            'total_price' => 'required|numeric',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'customer_id' => auth()->id(),
                'delivery_partner_id' => $validatedData['delivery_partner_id'] ?? null,
                'branch_id' => $validatedData['branch_id'],
                'delivery_location' => isset($validatedData['delivery_location']) ? json_encode($validatedData['delivery_location']) : null,
                'pickup_location' => isset($validatedData['pickup_location']) ? json_encode($validatedData['pickup_location']) : null,
                'delivery_person_location' => isset($validatedData['delivery_person_location']) ? json_encode($validatedData['delivery_person_location']) : null,
                'status' => 'available',
            ]);

            $totalAmount = 0;

            // Add products to the order
            foreach ($validatedData['products'] as $productData) {
                $product = Product::findOrFail($productData['id']);
                $quantity = $productData['quantity'];

                // Check if there's enough stock
                if ($product->stock < $quantity) {
                    throw new \Exception("Not enough stock for product: {$product->name}");
                }

                // Decrease the product stock
                $product->decrement('stock', $quantity);

                // Create order item
                $order->orderDetails()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);

                // $totalAmount += $product->price * $quantity;
            }

            // Update order total amount
            $order->update(['total_price' => $validatedData['total_price']]);

            // Commit the transaction
            DB::commit();
            $order->load(['orderDetails.product', 'branch', 'orderDetails']);
            return response()->json([
                'message' => 'Order created successfully',
                'order' => new OrderResource($order),
            ], 201);

        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function confirmOrder(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        try {
            $deliveryPerson = auth()->user();
            // $request->validate([
            //     'delivery_partner_id' => 'required|exists:users,id',
            // ]);
            // Check if the order status is 'available'
            if ($order->status !== 'available') {
                return response()->json([
                    'message' => 'Order cannot be confirmed. Current status: ' . $order->status,
                ], 400);
            }

            // Update the order
            $order->update([
                'status' => 'confirmed',
                'delivery_partner_id' => $deliveryPerson->id,
            ]);

            // Reload the order with its relationships
            $order->load(['orderDetails.product', 'branch']);
            ConfirmOrderEvent::dispatch($order);
            
            return response()->json([
                'message' => 'Order confirmed successfully',
                'order' => new OrderResource($order),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to confirm order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string',
            'delivery_person_location'=> 'required|array',
        ]);
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        try {
            if (in_array($order->status, ['cancelled', 'delivered'])) {
                return response()->json([
                    'message' => 'Order cannot be updated',
                ], 400);
            }
            $order->update([
                'status' => $validatedData['status'],
                'delivery_person_location'=> json_encode($validatedData['delivery_person_location']),

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to confirm order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getOrders(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'nullable|string',
            'delivery_partner_id' => 'nullable|exists:users,id',
            'customer_id' => 'nullable|exists:users,id',
        ]);

        $query = Order::query();

        $filterableFields = ['status', 'delivery_partner_id', 'customer_id'];

        foreach ($filterableFields as $field) {
            if (!empty($validatedData[$field])) {
                $query->where($field, $validatedData[$field]);
            }
        }

        $orders = $query->latest()->paginate(20);

        return OrderResource::collection($orders);
    }

    public function getOrderById($id) {
        $order = Order::with(['orderDetails' => function($query) {
            $query->with('product');
        }])->where('id',$id)->first();
   
        if(!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Orders retrieved successfully',
            'order' => new OrderResource($order),
        ], 200);
    }
}
