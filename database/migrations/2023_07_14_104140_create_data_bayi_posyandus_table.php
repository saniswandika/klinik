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
        Schema::create('data_bayi_posyandus', function (Blueprint $table) {
            $table->id();
            $table->integer('No');
            $table->integer('NIK');
            $table->string('Nama_Anak');
            $table->date('tgl_lahir');
            $table->integer('Umur_Tahun');
            $table->string('jenis_kelamin');
            $table->string('Nama_Ortu');
            $table->integer('Nik_Ortu');
            $table->integer('No_Hp_Ortu');
            $table->string('Pkm');
            $table->string('Kelurahan');
            $table->integer('Rt');
            $table->integer('Rw');
            $table->string('Alamat');
            $table->date('Tgl_Ukur');
            $table->float('tinggi_badan');
            $table->string('Cara_Ukur');
            $table->float('Berat_Badan');
            $table->float('Lila');
            $table->float('Lingkar_kepala');
            $table->float('Lingkar_Ukur');
            $table->string('status_gizi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bayi_posyandus');
    }
};
