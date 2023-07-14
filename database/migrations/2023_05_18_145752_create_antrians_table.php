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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id('id_antrian');
            $table->string('Nomor_antrian');
            // $table->text('Alamat');
            $table->date('tanggal_antrian');
            $table->time('waktu_antrian');
            // $table->string('jenis_kelamin');
            $table->unsignedBigInteger('id_pendafataran');
            $table->foreign('id_pendafataran')->references('id')->on('pendaftaran_pasiens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
