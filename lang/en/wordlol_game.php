<?php

return [
    'page_title' => 'WordLoL - Guess the League of Legends Word!',
    'page_description' => 'Play WordLoL, a fun word-guessing game based on the League of Legends universe. Try to guess the secret word with clues and a limited number of attempts!',
    'page_keywords' => 'HextechPlay, LoL mini games, online games, League of Legends quiz, runeterra, fun, quick games',
    'og_title' => 'HextechPlay – Mini Games and League of Legends Quizzes',
    'og_description' => 'Test your knowledge and have fun with fast-paced games inspired by Runeterra!',

    'title' => 'WordLoL',
    'attempts' => 'ATTEMPTS',
    'remaining' => 'REMAINING CHANCES',
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
    'guide' => [
        'title' => 'How to Play WordLoL',
        'item1' => 'Try to guess the word before reaching the maximum number of mistakes.',
        'item2' => 'Type one letter at a time or try guessing the whole word.',
        'item3' => 'Already tried words cannot be repeated.',
        'item4' => 'Share your results on Twitter after finishing.',
        'item5' => 'You have limited time for each word, stay alert!',
    ],
    'result' => [
        'win' => [
            'title' => '🎉 Congratulations! You win!',
            'item1' => 'You guessed today’s word!',
            'item2' => 'Crushing victory!',
            'item3' => 'Your Hextech IQ is 200!',
        ],
        'lost' => [
            'title' => '😢 Not this time...',
            'item1' => 'Try again tomorrow!',
            'item2' => 'The word was tough, but don’t give up!',
            'item3' => 'Better luck next round!',
        ],
        'word' => 'The word was:',
    ],
    'attempts_info' => 'ᵗʰ attempt',
    'error' => 'Mistakes: ',

    // Corrected phrase for the share invitation
    'invite_text' => 'Try it too at',

    'next_question' => 'Next question in',
    'share_result' => 'Share your result',
    'share_button' => [
        'twitter' => 'Share on X',
    ],
];
