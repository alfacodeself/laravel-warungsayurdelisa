<?php

namespace App\Models;

use App\Enums\DiscountType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hasDiscount()
    {
        return $this->discount_type !== DiscountType::NO_DISCOUNT->value && $this->discount_nominal > 0;
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
