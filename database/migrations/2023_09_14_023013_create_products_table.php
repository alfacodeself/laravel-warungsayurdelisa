<?php

use App\Enums\GeneralStatus;
use App\Enums\StockStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('product_image');
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->boolean('is_new_product')->default(false);
            $table->enum('stock', [StockStatus::STOCK_EMPTY->value, StockStatus::STOCK_FEW->value, StockStatus::STOCK_MANY->value]);
            $table->enum('status', [GeneralStatus::STATUS_ACTIVE->value, GeneralStatus::STATUS_INACTIVE->value])->default(GeneralStatus::STATUS_ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
