<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_obat';
    protected $fillable = [
        'nama_obat',
        'harga_obat'
    ];
}
