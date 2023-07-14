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
        Schema::create('gizi_bayi', function (Blueprint $table) {
            $table->id();
            $table->integer('usia');
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->string('jenis_kelamin');
            $table->string('status_gizi');
            // Tambahkan kolom lainnya sesuai kebutuhan

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gizi_bayi');
    }
};
