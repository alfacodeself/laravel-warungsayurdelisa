<?php

declare(strict_types=1);

namespace App\Enums;

enum GeneralStatus : string
{
    case STATUS_ACTIVE = 'active';
    case STATUS_INACTIVE = 'inactive';
}