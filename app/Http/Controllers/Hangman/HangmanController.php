<?php

namespace App\Http\Controllers\Hangman;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HangmanController extends Controller
{
    private $word = "TESTE"; // futuramente: pegar random do banco
    private $maxAttempts = 6;

    public function index(Request $request)
    {
        $session = $request->session();

        // inicializa estado do jogo
        if (!$session->has('hangman')) {
            $session->put('hangman', [
                'word' => $this->word,
                'guessed' => [],
                'wrong' => 0,
                'maxAttempts' => $this->maxAttempts,
            ]);
        }

        $state = $session->get('hangman');

        return inertia('Hangman/Index', [
            'displayWord' => $this->getDisplayWord($state['word'], $state['guessed']),
            'guessed'     => $state['guessed'],
            'wrong'       => $state['wrong'],
            'maxAttempts' => $state['maxAttempts'],
        ]);
    }

    public function guess(Request $request)
    {
        $letter = strtoupper($request->input('letter'));
        $session = $request->session();
        $state = $session->get('hangman');

        if (!in_array($letter, $state['guessed'])) {
            $state['guessed'][] = $letter;

            if (!str_contains($state['word'], $letter)) {
                $state['wrong']++;
            }
        }

        $session->put('hangman', $state);

        return response()->json([
            'displayWord' => $this->getDisplayWord($state['word'], $state['guessed']),
            'guessed'     => $state['guessed'],
            'wrong'       => $state['wrong'],
            'finished'    => $state['wrong'] >= $state['maxAttempts']
                           || !collect(str_split($state['word']))
                               ->diff($state['guessed'])
                               ->count(),
        ]);
    }

    private function getDisplayWord(string $word, array $guessed): string
    {
        return collect(str_split($word))
            ->map(fn ($letter) => in_array($letter, $guessed) ? $letter : '_')
            ->implode(' ');
    }

    public function restart(Request $request)
    {
        // aqui futuramente pode ser randomizada do banco
        $word = $this->word;

        $state = [
            'word'        => $word,
            'guessed'     => [],
            'wrong'       => 0,
            'maxAttempts' => $this->maxAttempts,
        ];

        $request->session()->put('hangman', $state);

        return response()->json([
            'displayWord' => $this->getDisplayWord($state['word'], $state['guessed']),
            'guessed'     => $state['guessed'],
            'wrong'       => $state['wrong'],
            'maxAttempts' => $state['maxAttempts'],
            'finished'    => false,
        ]);
    }

}
