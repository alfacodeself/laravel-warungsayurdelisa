<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = $value;
        $slug = Str::slug($value) . '-' . Carbon::now()->format('Y-m-d-his') . '-' . rand(10000, 99999);
        $this->attributes['slug'] = $slug;
    }

    public function scopeDiscountProducts($query)
    {
        return $query->with([
            'product_units' => function ($query) {
                $query->select('id', 'price', 'discount_type', 'discount_nominal', 'unit_id', 'product_id')->with('unit:id,unit_name');
            }
        ])
            ->whereHas('product_units', function ($query) {
                $query->where('discount_type', '!=', 'no discount')
                    ->whereNotNull('discount_nominal')
                    ->where('discount_nominal', '>', 0);
            });
    }

    public function scopeByCategorySlug($query, string $categorySlug)
    {
        return $query->whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_units()
    {
        return $this->hasMany(ProductUnit::class);
    }
}
