<?php

namespace App\Repositories\Eloquent;

use App\Models\Question;

class QuestionRepository
{
    public function getQuestionsWithTranslations(array $uuids, string $locale)
    {
        return Question::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale)
                  ->select('question_id', 'locale', 'text', 'correct_answer', 'options');
            }])
            ->whereIn('uuid', $uuids)
            ->get()
            ->keyBy('uuid');
    }

    public function getQuestionsForGame(string $difficulty, int $quantity, string $locale)
    {
        return Question::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale)
                  ->select('question_id', 'locale', 'text', 'correct_answer', 'options');
            }])
            ->where('difficulty', $difficulty)
            ->inRandomOrder()
            ->limit($quantity)
            ->get();
    }
}
