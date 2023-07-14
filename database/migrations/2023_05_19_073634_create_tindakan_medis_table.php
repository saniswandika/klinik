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
        Schema::create('tindakan_medis', function (Blueprint $table) {
            $table->string('id_tindakan_medis')->primary(); // Kolom primary key dengan tipe data string
            $table->unsignedBigInteger('id_dokter');
            $table->unsignedBigInteger('id_vitalsign');
            $table->string('jenis_tindakan');
            $table->string('hasil_tindakan');
            $table->date('tanggal_tindakan');
            $table->timestamps();
            $table->foreign('id_vitalsign')->references('id_vitalsign')->on('vitalsign')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('detail_tindakan_medis', function (Blueprint $table) {
            $table->id();
            $table->string('id_tindakan_medis'); // Foreign key dengan tipe data string
            $table->unsignedBigInteger('id_obat');
            $table->foreign('id_tindakan_medis')->references('id_tindakan_medis')->on('tindakan_medis')->onDelete('cascade');
            $table->foreign('id_obat')->references('id_obat')->on('obats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan_medis');
    }
};
