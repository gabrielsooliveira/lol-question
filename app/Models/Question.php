<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'difficulty'
    ];

    public function translations()
    {
        return $this->hasMany(QuestionTranslation::class);
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
            'id' => $t?->id,
            'text' => $t?->text ?? '',
            'options' => collect($t?->options ?? [])->shuffle(),
        ];
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
