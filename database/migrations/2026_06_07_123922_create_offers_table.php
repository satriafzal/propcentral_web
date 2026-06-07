<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            // Properti yang ditawar
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');

            // Pembeli
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');

            // Penjual 
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');

            // Harga penawaran dari pembeli
            $table->bigInteger('offered_price');

            // Harga listing asli saat penawaran dibuat
            $table->bigInteger('original_price');

            // Pesan dari pembeli (opsional)
            $table->text('message')->nullable();

            // Status penawaran
            $table->enum('status', ['pending', 'accepted', 'rejected', 'countered'])->default('pending');

            // Counter offer dari penjual
            $table->bigInteger('counter_price')->nullable();
            $table->text('counter_message')->nullable();

            // Waktu penjual merespons
            $table->timestamp('responded_at')->nullable();

            // Status baca
            $table->boolean('is_read_by_seller')->default(false);
            $table->boolean('is_read_by_buyer')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
