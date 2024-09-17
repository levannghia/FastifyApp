<?php

namespace App\Http\Enums;

enum UserRole: string
{
    case DELIVERYPARTNER = 'DeliveryPartner';
    case ADMIN = 'ADMIN';
    case CUSTOMER = 'Customer';
}