<?php

namespace App\Services;

use App\DTOs\GameSettingsDTO;
use Illuminate\Support\Facades\Session;

class GameSessionService
{
    public static function setGameSettings(GameSettingsDTO $settings): void
    {
        Session::put('game_settings', $settings->toArray());
    }

    public static function getGameSettings(): GameSettingsDTO
    {
        $data = Session::get('game_settings', [
            'difficulty' => 'easy',
            'questionQuant' => 5,
        ]);

        return GameSettingsDTO::fromArray($data);
    }
}
