<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyWord extends Model
{
    protected $fillable = ['date', 'runeterra_word_id'];

    protected $dates = ['date'];

    public function word()
    {
        return $this->belongsTo(RuneterraWord::class, 'runeterra_word_id');
    }
}
