<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('waste_category_id')->constrained()->onDelete('cascade');
            $table->string('transaction_code')->unique();
            $table->decimal('weight', 10, 2); // Berat sampah dalam kg
            $table->decimal('price_per_kg', 10, 2); // Harga saat transaksi
            $table->decimal('total_price', 15, 2); // Total harga
            $table->integer('points_earned')->default(0); // Poin yang didapat
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('transactions');
    }
};
