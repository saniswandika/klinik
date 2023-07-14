<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailtindakan extends Model
{
    use HasFactory;
    protected $table = 'detail_tindakan_medis';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_obat', // Add id_obat field to fillable
    ];
    // Relasi dengan model TindakanMedis
    public function tindakanMedis()
    {
        return $this->belongsTo(tindakan_medis::class, 'id_tindakan_medis');
    }

    // Relasi dengan model Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
