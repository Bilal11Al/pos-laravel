<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    protected $fillable = [
        'nilai1',
        'simbol',
        'nilai2',
        'hasil',
    ];
}
