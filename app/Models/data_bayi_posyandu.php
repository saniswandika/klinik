<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_bayi_posyandu extends Model
{
    use HasFactory;
    protected  $table = 'data_bayi_posyandus';
    protected $fillable = [
        'No',
        // 'NIK',
        'id_antrian',
        'id_perawat',
        'Nik_bayi',
        'Nama_Anak',
        'tgl_lahir',
        'Umur_Tahun',
        'Umur_bulan',
        'jenis_kelamin',
        'Nama_Ortu',
        'Nik_Ortu',
        'No_Hp_Ortu',
        'Pkm',
        'Kelurahan',
        'Posyandu',
        'Rt',
        'Rw',
        'Alamat',
        'Tgl_Ukur',
        'tinggi_badan',
        'Cara_Ukur',
        'Berat_Badan',
        'Lila',
        'Lingkar_kepala',
        'Lingkar_Ukur',
        'user_id',
        'status_gizi'
    ];
}
