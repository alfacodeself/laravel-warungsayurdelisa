<?php

namespace App\Services\Landingpage;

use App\Enums\ProductType;
use App\Filters\Products\ByCategory;
use App\Filters\Products\ByProductType;
use App\Http\Resources\Landingpage\ProductResource;
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
        $products = Pipeline::send(Product::query())->through($pipelines)->thenReturn()->paginate($paginate, ['*'], 'page', $page);
        $transformedProducts = $products->getCollection()->map(function ($product) {
            $resource = new ProductResource($product, );
            return $resource->toArray();
        });
        $products->setCollection($transformedProducts);
        return $products;
    }
}
