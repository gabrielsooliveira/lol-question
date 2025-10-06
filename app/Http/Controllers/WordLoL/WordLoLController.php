<?php

namespace App\Http\Controllers\WordLoL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DailyWord;
use Carbon\Carbon;

class WordLoLController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session();
        $today = Carbon::now('America/Sao_Paulo')->toDateString();

        $daily = DailyWord::with('word')->where('date', $today)->first();
        if (!$daily) {
            abort(404, "Palavra do dia ainda não definida.");
        }

        $word = strtoupper($daily->word->name);
        $maxAttempts = $daily->word->max_attempts;

        if ($session->has('wordlol') && $session->get('wordlol.date') === $today) {
            $state = $session->get('wordlol');
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
            $session->put('wordlol', $state);
        }

        $timeRemaining = $this->getTimeRemaining();

        return inertia('WordLoL/Game', [
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'finished' => $state['finished'],
            'maxAttempts' => $state['maxAttempts'],
            'word' => $state['lost'] || $state['won'] ? $state['word'] : null,
            'timeRemaining' => $timeRemaining
        ]);
    }

    public function guess(Request $request)
    {
        $session = $request->session();
        $state = $session->get('wordlol');

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
                'word' => $state['lost'] || $state['won'] ? $state['word'] : null,
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

        $session->put('wordlol', $state);

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
            'word' => $state['lost'] || $state['won'] ? $state['word'] : null,
            'timeRemaining' => $timeRemaining
        ]);
    }

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
        $word = str_replace(' ', '', $state['word']);
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
