<?php

use App\Enums\ProductCurrencyEnum;
use App\Enums\ProductStatusEnum;
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
            $table->string('name')->unique()->nullable()->index();
            $table->decimal('price', 7, 2)->nullable();
            $table->enum('currency', [ProductCurrencyEnum::KSA->value])->default(ProductCurrencyEnum::KSA->value);
            $table->string('sku')->nullable()->unique();
            $table->string('image_url')->nullable();
            $table->json('variations')->nullable();
            $table->enum('status', [
                ProductStatusEnum::SALE->value,
                ProductStatusEnum::OUT->value,
                ProductStatusEnum::HIDDEN->value,
                ProductStatusEnum::DELETED->value
            ])->default(ProductStatusEnum::HIDDEN->value);
            $table->softDeletes();
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
