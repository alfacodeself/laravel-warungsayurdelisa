<?php

declare(strict_types=1);

namespace App\Filters\Products;

use App\Enums\ProductType;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ReflectionClass;

class ByProductType
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->request->has('product_type')) {
            $productType = $this->request->product_type;
            if (!ProductType::tryFrom($productType)) {
                throw new Exception('Invalid product type', 419);
            }

            return $next($builder)->when($productType == 'new arrive', function ($products) {
                return $products->where('is_new_product', true);
            })->when($productType == 'discount', function ($products) {
                return $products->discountProducts();
            });
        }
        return $next($builder);
    }
}
