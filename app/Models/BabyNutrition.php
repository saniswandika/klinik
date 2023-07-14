<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BabyNutrition extends Model
{
    protected $fillable = ['age', 'weight', 'height', 'gender', 'nutrition_status'];
}