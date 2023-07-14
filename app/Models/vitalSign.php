<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class vitalSign extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'vitalsign';
    
    protected $primaryKey = 'id_vitalsign';
    protected $fillable = [
         'id_antrian',
         'rasi_oksigen',
         'id_pendaftaran',
         'id_perawat',
         'tekanan_darah',
         'suhu_tabuh',
         'laju_respirasi',
         'pulsu',
         'berat_badan',
         'status_gizi',
         'tinggi_badan',
         'created_at',
         'updated_at'
    ];
}
