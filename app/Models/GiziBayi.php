<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiziBayi extends Model
{
    protected $table = 'gizi_bayi';
    protected $fillable = [
        'usia',
        'berat_badan',
        'keterangan_berat_badan',
        'keterangan_umur_berat_badan',
        'Jenis_kelamin_berat_badan',
        'panjang_badan',
        'keterangan_panjang_badan',
        'jenis_kelamin_panjang_badan',
        'keterangan_umur_panjang_badan',
        'status_gizi'
        // Kolom lainnya
    ];
}
