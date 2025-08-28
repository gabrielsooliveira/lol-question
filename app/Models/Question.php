<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text',
        'correct_answer',
        'options'
    ];
}
