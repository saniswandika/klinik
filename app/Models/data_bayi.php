<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_bayi extends Model
{
    protected $table = 'data_bayis';
    protected $fillable = [
        'usia',
        'berat_badan',
        'panjang_badan',
        'jenis_kelamin',
        'status_gizi',
        // Kolom lainnya
    ];
}
