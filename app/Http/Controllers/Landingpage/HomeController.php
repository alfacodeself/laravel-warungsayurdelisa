<?php

namespace App\Http\Controllers\Landingpage;

use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Services\Landingpage\ProductService;

class HomeController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $discount_products = $this->productService->getProducts(7, 1, null, ProductType::DISCOUNT_PRODUCTS);
        $new_arrive_products = $this->productService->getProducts(7, 1, null, ProductType::NEW_ARRIVE_PRODUCTS);
        $all_products = $this->productService->getProducts(7, 1, null, ProductType::ALL_PRODUCTS);
        return $discount_products;
    }
}
