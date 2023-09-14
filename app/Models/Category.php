<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = $value;
        $slug = Str::slug($value) . '-' . Carbon::now()->format('Y-m-d-his') . '-' . rand(10000, 99999);
        $this->attributes['slug'] = $slug;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
