<?php

declare(strict_types=1);

namespace App\Enums;

enum CustomerStatus : string
{
    case CUSTOMER_VERIFIED = 'verified';
    case CUSTOMER_UNVERIFIED = 'unverified';
}