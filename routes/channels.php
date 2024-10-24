<?php

use App\Http\Enums\UserRole;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('confirm.order.{id}', function($user, int $id){
    $order = Order::find($id);
    if($order) {
        return true;
    }
    return false;
});

Broadcast::channel('order.status.{customerId}-{deliveryPartnerId}', function (User $user, int $customerId, int $deliveryPartnerId) {
    return $user->id === $customerId || $user->id === $deliveryPartnerId ? $user : null;
});