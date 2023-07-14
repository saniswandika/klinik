<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran_pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nama_pasien',
         'Alamat',
         'tanggal_pendaftaran',
         'waktu_pendaftaran',
         'jenis_kelamin',
         'role_id',
         'klinik_id',
         'user_id',
         'created_at',
         'updated_at'
    ];
}
