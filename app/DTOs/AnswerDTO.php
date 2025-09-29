<?php

namespace App\DTOs;

class AnswerDTO
{
    public function __construct(
        public string $questionId,
        public string $answer,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['question_id'],
            $data['answer']
        );
    }
}
