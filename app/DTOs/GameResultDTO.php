<?php

namespace App\DTOs;

class GameResultDTO
{
    public function __construct(
        public int $totalQuestions,
        public array $correctAnswers,
        public array $wrongAnswers,
    ) {}

    public function toArray(): array
    {
        return [
            'total_questions' => $this->totalQuestions,
            'correct_answers' => $this->correctAnswers,
            'wrong_answers'   => $this->wrongAnswers,
        ];
    }
}
