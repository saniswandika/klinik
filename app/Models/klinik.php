<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class klinik extends Model
{
    use HasFactory;
    protected $fillable = [
         'nama_klinik',
         'Alamat',
         'no_telepon',
         'waktu_pendaftaran',
         'jenis_kelamin',
         'role_id',
         'klinik_id',
         'user_id',
         'created_at',
         'updated_at'
    ];
}
