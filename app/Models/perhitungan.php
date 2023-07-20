<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perhitungan extends Model
{
    use HasFactory;

    protected $fillable = [
      'node',
      'attribute',
      'nilai_attribute',
      'hasil',
      'entropy',
      'gain'
  ];
}
