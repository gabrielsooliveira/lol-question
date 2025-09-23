<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    use HasFactory;

     protected $primaryKey = null;
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'locale',
        'text',
        'options',
        'correct_answer',
        'question_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'uuid');
    }
}
