<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name_id');
            $table->string('name_en');
            $table->string('slug');
            $table->text('description_id');
            $table->text('description_en');
            $table->decimal('price_idr', 15, 2);
            $table->decimal('price_usd', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->json('images')->nullable();
            $table->string('sku')->unique();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
