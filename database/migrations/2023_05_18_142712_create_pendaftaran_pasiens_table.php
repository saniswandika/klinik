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
        Schema::create('pendaftaran_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_pasien');
            $table->text('Alamat');
            $table->date('tanggal_pendaftaran');
            $table->time('waktu_pendaftaran');
            $table->string('jenis_kelamin');
            $table->string('status');
            $table->string('created_by');
            $table->string('updated_by');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('klinik_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('klinik_id')->references('id')->on('kliniks')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pasiens');
    }
};
