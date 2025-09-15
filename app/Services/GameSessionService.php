<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class GameSessionService
{
    /**
     * Store the game settings in the session.
     *
     * @param array $settings
     * @return void
     */
    public static function setGameSettings(array $settings)
    {
        Session::put('game_settings', [
            'difficulty' => $settings['difficulty'],
        ]);
    }

    /**
     * Retrieve the current game settings.
     *
     * @return array
     */
    public static function getGameSettings()
    {
        return Session::get('game_settings', [
            'difficulty' => 'easy',
        ]);
    }
}
