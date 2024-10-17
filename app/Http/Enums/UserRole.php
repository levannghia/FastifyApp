<?php

namespace App\Http\Enums;

enum UserRole: string
{
    case DELIVERYPARTNER = 'DeliveryPartner';
    case ADMIN = 'Admin';
    case CUSTOMER = 'Customer';
}