<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    protected $fillable = [
        'locale',
        'text',
        'options',
        'correct_answer'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
