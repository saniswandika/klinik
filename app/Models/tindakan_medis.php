<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tindakan_medis extends Model
{
    use HasFactory;
    protected $table = 'tindakan_medis';
    protected $primaryKey = 'id_tindakan_medis';
    public $timestamps = true;
    public $incrementing = false;
    protected $fillable = [
        'id_dokter',
        'id_vitalsign',
        'jenis_tindakan',
        'hasil_tindakan',
        'tanggal_tindakan',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastId = self::max('id_tindakan_medis');
            $lastNumber = (int) substr($lastId, 2);
            $newNumber = $lastNumber + 1;
            $newId = 'TM' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $model->id_tindakan_medis = $newId;
        });
    }

    // Relasi dengan model User (dokter)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    // Relasi dengan model VitalSign
    public function vitalSign()
    {
        return $this->belongsTo(VitalSign::class, 'id_vitalsign');
    }

    // Relasi dengan model DetailTindakanMedis
    public function detailtindakan()
    {
        return $this->hasMany(detailtindakan::class, 'id_tindakan_medis');
    }
}
