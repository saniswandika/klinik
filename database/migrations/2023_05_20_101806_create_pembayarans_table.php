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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran'); // Kolom primary key dengan tipe data string
            $table->unsignedBigInteger('id_detail_tindakan_medis');
            $table->date('Tanggal_Pembayaran');
            $table->decimal('total_pembayaran', 10, 2);
            $table->string('Total_Harga');
            $table->string('metode_pembayaran');
            $table->timestamps();
            $table->foreign('id_detail_tindakan_medis')->references('id')->on('detail_tindakan_medis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
