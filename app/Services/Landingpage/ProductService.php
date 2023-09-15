<?php

namespace App\Services\Landingpage;

use App\Enums\ProductType;
use App\Filters\Products\ByCategory;
use App\Filters\Products\ByProductType;
use App\Models\Product;
use Illuminate\Support\Facades\Pipeline;

class ProductService
{
    public function getProducts(int $paginate = 8, int $page = 1, $category = null, ProductType $productType = ProductType::ALL_PRODUCTS)
    {
        $pipelines = [new ByProductType($productType)];
        if ($category != null) {
            array_push($pipelines, ByCategory::class);
        }
        return Pipeline::send(Product::query())
            ->through($pipelines)
            ->thenReturn()
            ->paginate($paginate, ['*'], 'page', $page);
    }

    // public function query()
    // {
    // }
}
