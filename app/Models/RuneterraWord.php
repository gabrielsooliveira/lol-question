<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuneterraWord extends Model
{
    protected $fillable = [
        'name',
        'max_attempts'
    ];

    public function dailyWords()
    {
        return $this->hasMany(DailyWord::class);
    }
}
