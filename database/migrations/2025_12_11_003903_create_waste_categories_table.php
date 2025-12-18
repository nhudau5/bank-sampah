<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('waste_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Plastik, Kertas, Logam, dll
            $table->text('description')->nullable();
            $table->decimal('price_per_kg', 10, 2); // Harga per kilogram
            $table->integer('points_per_kg')->default(10); // Poin per kilogram
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('waste_categories');
    }
};
