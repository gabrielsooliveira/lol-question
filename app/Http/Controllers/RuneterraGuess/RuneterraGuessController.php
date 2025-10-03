<?php

namespace App\Http\Controllers\RuneterraGuess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyWord;
use Carbon\Carbon;

class RuneterraGuessController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session();
        $today = Carbon::now('America/Sao_Paulo')->toDateString();

        // Busca a palavra do dia
        $daily = DailyWord::with('word')->where('date', $today)->first();
        if (!$daily) {
            abort(404, "Palavra do dia ainda não definida.");
        }

        $word = strtoupper($daily->word->name);
        $maxAttempts = $daily->word->max_attempts;

        // Mantém estado do dia ou cria se não houver
        if ($session->has('hangman') && $session->get('hangman.date') === $today) {
            $state = $session->get('hangman');
        } else {
            $state = [
                'date' => $today,
                'word' => $word,
                'guessed' => [],
                'wrongLetters' => [],
                'wrong' => 0,
                'maxAttempts' => $maxAttempts,
                'lost' => false,
                'won' => false,
                'finished' => false,
            ];
            $session->put('hangman', $state);
        }

        // Calcula tempo restante até próxima palavra
        $timeRemaining = $this->getTimeRemaining();

        return inertia('RuneterraGuess/Game', [
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'finished' => $state['finished'],
            'maxAttempts' => $state['maxAttempts'],
            'word' => $state['lost'] ? $state['word'] : null,
            'timeRemaining' => $timeRemaining
        ]);
    }

    public function guess(Request $request)
    {
        $session = $request->session();
        $state = $session->get('hangman');

        if ($state['finished']) {
            return response()->json([
                'error' => 'Você já jogou hoje! Volte amanhã para a próxima palavra.',
                'displayWord' => $this->getDisplayWord($state),
                'guessed' => $state['guessed'],
                'wrongLetters' => $state['wrongLetters'],
                'wrong' => $state['wrong'],
                'lost' => $state['lost'],
                'won' => $state['won'],
                'maxAttempts' => $state['maxAttempts'],
                'finished' => $state['finished'],
                'word' => $state['lost'] ? $state['word'] : null
            ]);
        }

        $letter = strtoupper($request->input('letter', ''));
        $wordInput = strtoupper($request->input('word', ''));

        if ($wordInput) {
            // Tentativa de adivinhar palavra inteira
            if ($wordInput === $state['word']) {
                $state['won'] = true;
            } else {
                $state['wrong']++;
                if ($state['wrong'] >= $state['maxAttempts']) {
                    $state['lost'] = true;
                }
            }
        } elseif ($letter && !in_array($letter, $state['guessed'])) {
            // Tentativa de letra
            $state['guessed'][] = $letter;

            if (strpos($state['word'], $letter) !== false) {
                if ($this->hasWon($state)) {
                    $state['won'] = true;
                }
            } else {
                $state['wrongLetters'][] = $letter;
                $state['wrong']++;
                if ($state['wrong'] >= $state['maxAttempts']) {
                    $state['lost'] = true;
                }
            }
        }

        if ($state['lost'] || $state['won']) {
            $state['finished'] = true;
        }

        $session->put('hangman', $state);

        // Tempo restante até próxima palavra
        $timeRemaining = $this->getTimeRemaining();

        return response()->json([
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'finished' => $state['finished'],
            'maxAttempts' => $state['maxAttempts'],
            'word' => $state['lost'] ? $state['word'] : null,
            'timeRemaining' => $timeRemaining
        ]);
    }

    // -----------------------------
    // Funções auxiliares
    // -----------------------------

    private function getDisplayWord(array $state): string
    {
        $word = $state['word'];
        $guessed = $state['guessed'];

        $display = '';
        for ($i = 0; $i < strlen($word); $i++) {
            $char = $word[$i];
            if (in_array($char, $guessed) || $state['lost'] || $state['won'] || $char === ' ') {
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
        $word = str_replace(' ', '', $state['word']); // Ignora espaços
        $guessed = $state['guessed'];

        foreach (str_split($word) as $char) {
            if (!in_array($char, $guessed)) {
                return false;
            }
        }

        return true;
    }

    private function getTimeRemaining(): array
    {
        $now = Carbon::now('America/Sao_Paulo');
        $nextMidnight = $now->copy()->addDay()->startOfDay();
        $diff = $nextMidnight->diff($now);

        return [
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s
        ];
    }
}
