<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Kpop extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'idols';

   protected $fillable = ['stage_name', 'full_name', 'korean_name', 'k_name', 'date_of_birth', 'group', 'country', 'k_height', 'k_weight', 'k_birthplace', 'gender', 'instagram'];
}
