<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductType : string
{
    case ALL_PRODUCTS = 'all';
    case DISCOUNT_PRODUCTS = 'discount';
    case NEW_ARRIVE_PRODUCTS = 'new arrive';
}