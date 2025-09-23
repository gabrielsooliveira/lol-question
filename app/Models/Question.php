<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Question extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'difficulty',
        'region_id'
    ];

    public function translations()
    {
        return $this->hasMany(QuestionTranslation::class, 'question_id', 'uuid');
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations->firstWhere('locale', $locale);
    }

    public function getLocalizedData($locale = null)
    {
        $t = $this->translation($locale);
        return [
            'id' => $this->uuid,
            'text' => $t?->text ?? '',
            'options' => collect($t?->options, true)->shuffle() ?? [],
        ];
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
