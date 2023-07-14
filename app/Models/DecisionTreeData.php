<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionTreeData extends Model
{
    protected $table = 'decision_tree_data';
    protected $fillable = [
        'attribute',
        'entropy',
        'gain',
        'jenis_kelamin',
        'status_gizi',
        // Kolom lainnya
    ];
}
