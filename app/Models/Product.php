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

    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = $value;
        $slug = Str::slug($value) . '-' . Carbon::now()->format('Y-m-d-his') . '-' . rand(10000, 99999);
        $this->attributes['slug'] = $slug;
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
