<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_code', 50)->unique();
            $table->string('brand_name', 100);
            $table->string('origin_country', 100);
            $table->string('founder_name', 100);
            $table->integer('established_year');
            $table->string('contact_email', 100);
            $table->string('phone_number', 30);
            $table->text('headquarters_address');
            $table->string('website_url', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};