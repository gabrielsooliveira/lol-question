<?php

namespace App\Http\Controllers\Hangman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HangmanController extends Controller
{
    private $words = [
        'LARAVEL',
        'INERTIA',
        'VUEJS',
        'BOOTSTRAP',
        'HANGMAN',
        'JAVASCRIPT',
        'FRAMEWORK',
        'DESENVOLVIMENTO',
        'PROGRAMACAO',
        'TECNOLOGIA'
    ];

    private $maxAttempts = 6;

    public function index(Request $request)
    {
        $session = $request->session();

        // Inicializa novo jogo se não existir ou se foi solicitado reset
        if (!$session->has('hangman') || $request->get('reset')) {
            $word = $this->words[array_rand($this->words)];
            $session->put('hangman', [
                'word' => $word,
                'guessed' => [],
                'wrongLetters' => [],
                'wrong' => 0,
                'maxAttempts' => $this->maxAttempts,
                'lost' => false,
                'won' => false,
            ]);
        }

        $state = $session->get('hangman');

        return inertia('Hangman/Index', [
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'maxAttempts' => $state['maxAttempts'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'word' => $state['lost'] ? $state['word'] : null, // Só mostra a palavra se perdeu
            'missingLetters' => $this->getMissingLetters($state),
        ]);
    }

    public function guess(Request $request)
    {
        $session = $request->session();
        $state = $session->get('hangman');

        if ($state['lost'] || $state['won']) {
            return response()->json([
                'error' => 'Jogo já finalizado',
                'displayWord' => $this->getDisplayWord($state),
                'guessed' => $state['guessed'],
                'wrongLetters' => $state['wrongLetters'],
                'wrong' => $state['wrong'],
                'lost' => $state['lost'],
                'won' => $state['won'],
                'maxAttempts' => $state['maxAttempts'],
                'word' => $state['lost'] ? $state['word'] : null,
                'missingLetters' => $this->getMissingLetters($state),
            ]);
        }

        $letter = strtoupper($request->input('letter', ''));
        $word = strtoupper($request->input('word', ''));

        // Tentativa de palavra completa
        if ($word) {
            if ($word === $state['word']) {
                $state['won'] = true;
            } else {
                $state['wrong']++;
                if ($state['wrong'] >= $state['maxAttempts']) {
                    $state['lost'] = true;
                }
            }
        }
        // Tentativa de letra
        elseif ($letter && !in_array($letter, $state['guessed'])) {
            $state['guessed'][] = $letter;

            if (strpos($state['word'], $letter) !== false) {
                // Letra correta - verifica se ganhou
                if ($this->hasWon($state)) {
                    $state['won'] = true;
                }
            } else {
                // Letra incorreta
                $state['wrongLetters'][] = $letter;
                $state['wrong']++;

                if ($state['wrong'] >= $state['maxAttempts']) {
                    $state['lost'] = true;
                }
            }
        }

        $session->put('hangman', $state);

        return response()->json([
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'maxAttempts' => $state['maxAttempts'],
            'word' => $state['lost'] ? $state['word'] : null,
            'missingLetters' => $this->getMissingLetters($state),
        ]);
    }

    public function reset(Request $request)
    {
        $request->session()->forget('hangman');
        return redirect()->route('hangman.index');
    }

    private function getDisplayWord(array $state): string
    {
        $word = $state['word'];
        $guessed = $state['guessed'];

        $display = '';
        for ($i = 0; $i < strlen($word); $i++) {
            $char = $word[$i];
            if (in_array($char, $guessed) || $state['lost'] || $state['won']) {
                $display .= $char;
            } else {
                $display .= '_';
            }
            if ($i < strlen($word) - 1) {
                $display .= ' ';
            }
        }

        return $display;
    }

    private function hasWon(array $state): bool
    {
        $word = $state['word'];
        $guessed = $state['guessed'];

        for ($i = 0; $i < strlen($word); $i++) {
            if (!in_array($word[$i], $guessed)) {
                return false;
            }
        }

        return true;
    }

    private function getMissingLetters(array $state): array
    {
        if ($state['won'] || $state['lost']) {
            return [];
        }

        $word = $state['word'];
        $guessed = $state['guessed'];
        $missing = [];

        for ($i = 0; $i < strlen($word); $i++) {
            $char = $word[$i];
            if (!in_array($char, $guessed) && !in_array($char, $missing)) {
                $missing[] = $char;
            }
        }

        return $missing;
    }
}
