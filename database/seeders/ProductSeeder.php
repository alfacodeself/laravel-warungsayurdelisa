<?php

namespace Database\Seeders;

use App\Enums\DiscountType;
use App\Enums\StockStatus;
use App\Models\Product;
use App\Models\ProductUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productImage = [
            'assets/landingpage/img/produk1.jpg',
            'assets/landingpage/img/produk2.jpg',
            'assets/landingpage/img/produk3.jpg',
            'assets/landingpage/img/produk4.jpg',
        ];
        for ($i = 0; $i < 50; $i++) {
            $product = Product::create([
                'category_id' => rand(1, 8),
                'product_name' => fake('id')->text(8),
                'product_image' => $productImage[rand(0, 3)],
                'stock' => StockStatus::STOCK_FEW->value,
            ]);
            $randUnits = rand(2, 3);
            for ($j = 0; $j < $randUnits; $j++) {
                $discountPrecision = rand(0, 2);
                switch ($discountPrecision) {
                    case '1':
                        $discounType = DiscountType::FLAT->value;
                        $discountNominal = rand(10, 30) * 1000;
                        break;
                    case '2':
                        $discounType = DiscountType::PERCENTAGE->value;
                        $discountNominal = rand(3, 10);
                        break;
                    default:
                        $discounType = DiscountType::NO_DISCOUNT->value;
                        $discountNominal = null;
                        break;
                }
                $pruchase_price = rand(15, 120) * 1000;
                $selling_price = $pruchase_price + rand(15, 100) * 1000;
                ProductUnit::create([
                    'product_id' => $product->id,
                    'unit_id' => rand(1, 15),
                    'purchase_price' => $pruchase_price,
                    'selling_price' => $selling_price,
                    'discount_type' => $discounType,
                    'discount_nominal' => $discountNominal,
                ]);
            }
        }
    }
}
