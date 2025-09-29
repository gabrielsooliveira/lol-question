<?php

namespace App\DTOs;

class GameSettingsDTO
{
    public function __construct(
        public string $difficulty,
        public int $questionQuant,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['difficulty'],
            $data['questionQuant']
        );
    }

    public function toArray(): array
    {
        return [
            'difficulty' => $this->difficulty,
            'questionQuant' => $this->questionQuant,
        ];
    }
}
