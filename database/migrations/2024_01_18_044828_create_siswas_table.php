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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kartu');
            $table->foreignId('sekolah_id')->constrained('sekolahs');
            $table->string('nama_lengkap');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->foreignId('jurusan_id')->constrained('jurusans');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->string('nis')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
