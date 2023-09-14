<?php

declare(strict_types=1);

namespace App\Enums;

enum StockStatus : string
{
    case STOCK_FEW = 'few';
    case STOCK_MANY = 'many';
    case STOCK_EMPTY = 'empty';
}