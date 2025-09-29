<?php

namespace App\UseCases\LoreQuestion;

use App\Services\GameSessionService;
use App\Repositories\Eloquent\QuestionRepository;
use App\DTOs\QuestionDTO;

class StartGameUseCase
{
    public function __construct(
        protected GameSessionService $gameSession,
        protected QuestionRepository $questionRepository
    ) {}

    public function execute(string $locale): array
    {
        $settings = $this->gameSession::getGameSettings();

        $questions = $this->questionRepository
            ->getQuestionsForGame($settings->difficulty, $settings->questionQuant, $locale);

        return $questions
            ->map(fn($q) => QuestionDTO::fromModel($q, $locale))
            ->filter()
            ->map->toArray()
            ->values()
            ->toArray();
    }
}
