<?php

return [
    'title' => 'Hangman Game',
    'attempts' => 'ATTEMPTS',
    'remaining' => 'REMAINING',
    'status' => [
        'won' => '🎉 Congratulations! You won!',
        'lost' => '😢 You lost!',
        'lost_word' => 'The word was:',
        'playing' => 'Type a letter or try the whole word',
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
