<?php

namespace App\Repositories\Interface;

use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

interface QuestionRepositoryInterface
{
    public function getQuestionsWithTranslations(array $uuids, string $locale): Collection;

    public function getQuestionsForGame(string $difficulty, int $quantity, string $locale): Collection;
}
