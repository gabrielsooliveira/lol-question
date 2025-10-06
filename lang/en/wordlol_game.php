<?php

return [
    'page_title' => 'WordLoL - Guess the League of Legends Word!',
    'page_description' => 'Play WordLoL, a fun word-guessing game based on the League of Legends universe. Try to guess the secret word with clues and a limited number of attempts!',
    'title' => 'WordLoL',
    'attempts' => 'ATTEMPTS',
    'remaining' => 'REMAINING',
    'status' => [
        'won' => '🎉 Congratulations! You won!',
        'lost' => '😢 You lost!',
        'lost_word' => 'The word was:',
        'playing' => 'Type a letter or try the whole word',
    ],
    "share_result" => "Compartilhar Resultado",
    'share' => [
        'won' => "Acertei {score} letras na palavra! Difícil!",
        "lost" => "Não consegui! A palavra era: {word}",
        "unsupported" => "Compartilhamento não suportado neste navegador."
    ],
    'input' => [
        'placeholder' => 'Enter a letter or word',
        'button_try' => '✅ Try',
        'button_loading' => '⏳',
        'error_invalid' => 'Only letters are allowed!',
        'error_repeat' => 'You already tried this letter!',
        'error_generic' => 'Error processing attempt. Try again.',
    ],
    'wrong_letters' => [
        'title' => '❌ Wrong Letters',
        'none' => 'None yet',
    ],
    'hint' => '💡 Tip: Type a letter or the full word to guess!',
];
