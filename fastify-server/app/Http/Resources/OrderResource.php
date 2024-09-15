<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "customer_id"=> $this->customer_id,
            "delivery_partner_id" => $this->delivery_partner_id,
            "branch_id" => $this->branch_id,
            "delivery_location" => $this->delivery_location,
            "pickup_location" => $this->pickup_location,
            "delivery_person_location" => $this->delivery_person_location,
            "order_details" => OrderDetailResource::collection($this->whenLoaded("orderDetails")),
            "status" => $this->status,
            "total_price" => $this->total_price,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
