<?php

declare(strict_types=1);

namespace App\Filters\Products;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByCategory
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)->when($this->request->has('category'), function ($products) {
            return $products->byCategorySlug($this->request->category);
        });
    }
}
