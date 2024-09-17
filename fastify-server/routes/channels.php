<?php

use App\Http\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('confirm.order.{delivery_partner_id}', function(User $user, int $delivery_partner_id){
    return $user->role == UserRole::DELIVERYPARTNER->value && (int) $user->id === (int) $delivery_partner_id ? true : false ;
});
