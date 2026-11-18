<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clothes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('sku', 50)->unique();
            $table->string('item_name', 150);
            $table->string('category', 50);
            $table->string('size', 10);
            $table->string('color', 50);
            $table->string('material', 100);
            $table->integer('price')->unsigned();
            $table->integer('stock')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clothes');
    }
};