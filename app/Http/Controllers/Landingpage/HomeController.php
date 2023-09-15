<?php

namespace App\Http\Controllers\Landingpage;

use App\Data\Carrousel;
use App\Data\Feature;
use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $data['carrousels'] = Carrousel::getCarrousels();
        $data['features'] = Feature::getFeatures();
        $data['discount_products'] = $this->productService->getProducts(7, 1, null, ProductType::DISCOUNT_PRODUCTS);
        $data['new_arrive_products'] = $this->productService->getProducts(7, 1, null, ProductType::NEW_ARRIVE_PRODUCTS);
        $data['categories'] = Category::get(['slug', 'category_name', 'category_image']);
        // dd($data['new_arrive_products']);
        return view('landingpage.home', $data);
    }
    public function show(ProductType $productType = ProductType::ALL_PRODUCTS)
    {
        dd($productType);
    }
}
