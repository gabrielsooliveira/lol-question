<?php

namespace App\DTOs;

use App\Models\Question;

class QuestionDTO
{
    public function __construct(
        public string $uuid,
        public string $text,
        public array $options,
    ) {}

    public static function fromModel(Question $question, string $locale): ?self
    {
        $translation = $question->translations->first();
        if (!$translation) {
            return null;
        }

        return new self(
            $question->uuid,
            $translation->text,
            $translation->options, true ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'uuid'    => $this->uuid,
            'text'    => $this->text,
            'options' => $this->options,
        ];
    }
}
