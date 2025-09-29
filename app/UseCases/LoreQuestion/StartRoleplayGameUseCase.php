<?php

namespace App\UseCases\LoreQuestion;

use App\DTOs\GameSettingsDTO;
use App\Services\GameSessionService;

class StartRoleplayGameUseCase
{
    public function execute(GameSettingsDTO $settings): void
    {
        GameSessionService::setGameSettings($settings);
    }
}
