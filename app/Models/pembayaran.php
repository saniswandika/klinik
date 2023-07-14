<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['detail_tindakan_medis', 'total_pembayaran'];
    protected $primaryKey = 'id_pembayaran';
    public function tindakanMedis()
    {
        return $this->belongsTo(detailtindakan::class, 'id_tindakan_medis');
    }
}