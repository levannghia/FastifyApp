<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_id",
        "delivery_partner_id",
        "branch_id",
        "delivery_location",
        "pickup_location",
        "delivery_person_location",
        "status",
        "total_price"
    ];

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function branch () {
        return $this->belongsTo(Branch::class);
    }

    protected function casts(): array
    {
        return [
            'delivery_person_location' => 'array',
        ];
    }
}
