<?php

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
            $table->string('kode_product');
            $table->string('nama_product');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->decimal('harga', 10, 2);
            $table->decimal('diskon', 5, 2)->nullable();
            $table->decimal('pajak', 5, 2);
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
