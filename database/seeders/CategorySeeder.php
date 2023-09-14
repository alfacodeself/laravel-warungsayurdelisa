<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryImage = [
            'assets/landingpage/img/kategorisayur.jpg',
            'assets/landingpage/img/logobuah.jpg',
            'assets/landingpage/img/logodaging.jpg',
            'assets/landingpage/img/logosembako.jpg',
        ];
        for ($i=0; $i < 8; $i++) { 
            Category::create([
                'category_image' => $categoryImage[rand(0, 3)],
                'category_name' => fake('id')->text(5),
            ]);
        }
    }
}
