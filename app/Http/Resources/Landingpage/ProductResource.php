<?php

namespace App\Http\Resources\Landingpage;

use App\Enums\DiscountType;
use App\Enums\StockStatus;
use App\Models\Product;

class ProductResource
{
    protected $product;
    protected $unit;

    public function __construct(Product $product)
    {
        $this->product = $product->load('product_units');
        $this->unit = $product->product_units();
    }
    public function toArray(): array
    {
        $stock = StockStatus::tryFrom($this->product->stock);
        return [
            'slug' => $this->product->slug,
            'image' => asset($this->product->product_image),
            'name' => $this->product->product_name,
            'stock' => $this->generateStockHTML($stock),
            'price' => $this->generatePriceHTML(),
        ];
    }
    private function generateStockHTML(StockStatus $stock)
    {
        $bg = 'bg-info';
        if ($stock == StockStatus::STOCK_EMPTY) {
            $bg = 'bg-danger';
            $st = 'habis';
        } elseif ($stock == StockStatus::STOCK_FEW) {
            $st = 'sedikit';
            $bg = 'bg-warning';
        } elseif ($stock == StockStatus::STOCK_MANY) {
            $st = 'banyak';
            $bg = 'bg-primary';
        }
        return '<div class="product-label ' . $bg . ' text-white text-uppercase">' . $st . '</div>';
    }
    public function generatePriceHTML()
    {
        $unit = $this->unit->firstWhere('discount_type', '!=', DiscountType::NO_DISCOUNT->value && 'discount_nominal' > 0);
        if (!$unit) {
            $unit = $this->unit->firstOrFail();
        }
        $selling_price = $this->calculateSellingPrice($unit);
        $priceHTML = '<p class="card-text">';
        if ($unit->hasDiscount()) {
            $priceHTML .= '<del class="text-warning font-weight-bold"> Rp ' . number_format($unit->selling_price, 0, '.', '.') . ' </del>';
        }
        $priceHTML .= '<strong style="mix-blend-mode: hard-light;"> Rp ' . number_format($selling_price, 0, '.', '.') . ' </strong>';
        $priceHTML .= '</p>';

        return $priceHTML;
    }

    public function calculateSellingPrice($unit)
    {
        $discountType = DiscountType::from($unit->discount_type);
        $selling_price = $unit->selling_price;
        if ($discountType == DiscountType::FLAT) {
            $selling_price -= $unit->discount_nominal;
        } elseif ($discountType == DiscountType::PERCENTAGE) {
            $percentageValue = ($unit->discount_nominal / 100) * $unit->selling_price;
            $selling_price -= $percentageValue;
        }
        return $selling_price;
    }
}
