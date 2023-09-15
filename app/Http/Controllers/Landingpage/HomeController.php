<?php

namespace App\Http\Controllers\Landingpage;

use App\Filters\Products\ByCategory;
use App\Filters\Products\ByProductType;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Pipeline;

class HomeController extends Controller
{
    public function index()
    {
        $pipelines = [
            ByCategory::class,
            ByProductType::class
        ];
        $products = Pipeline::send(Product::query())
                ->through($pipelines)
                ->thenReturn()
                ->paginate(7);
        return $products;
    }
}
