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
        Schema::create('vitalsign', function (Blueprint $table) {
            $table->id('id_vitalsign');
            $table->string('tekanan_darah');
            $table->text('suhu_tubuh');
            $table->string('laju_respirasi');
            $table->string('pulsu');
            $table->string('created_by');
            $table->string('updated_by');
            $table->unsignedBigInteger('id_antrian');
            $table->unsignedBigInteger('id_perawat');
            $table->foreign('id_antrian')->references('id_antrian')->on('antrians')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_perawat')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
