<?php

declare(strict_types=1);

namespace App\Filters\Products;

use App\Enums\ProductType;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByProductType
{
    // protected $request;

    public function __construct(protected ProductType $productType = ProductType::ALL_PRODUCTS)
    {
        // $this->request = $request;
    }

    public function handle(Builder $builder, Closure $next)
    {
        // if ($this->request->has('product_type')) {
        //     $productType = $this->request->product_type;
        //     if (!ProductType::tryFrom($productType)) {
        //         throw new Exception('Invalid product type', 419);
        //     }
        // }
        return $next($builder)->when($this->productType == ProductType::NEW_ARRIVE_PRODUCTS, function ($products) {
            return $products->where('is_new_product', true);
        })->when($this->productType == ProductType::DISCOUNT_PRODUCTS, function ($products) {
            return $products->discountProducts();
        });
    }
}
