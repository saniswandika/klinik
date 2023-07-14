<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antrian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_antrian';
    protected $fillable = [
        'Nomor_antrian', 'tanggal_antrian','waktu_antrian','waktu_pendaftaran','id_pendafataran',
    ];
}
