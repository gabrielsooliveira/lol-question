<?php

namespace App\Http\Controllers\RuneterraGuess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuneterraGuessController extends Controller
{
    private $words = [
        "AATROX", "AHRI", "AKALI", "AKSHAN", "ALISTAR", "AMUMU", "ANIVIA", "ANNIE", "APHELIOS", "ASHE",
        "AURELION SOL", "AURORA", "AZIR", "BARD", "BEL'VETH", "BLITZCRANK", "BRAND", "BRAUM", "BRIAR", "CAITLYN",
        "CAMILLE", "CASSIOPEIA", "CHO'GATH", "CORKI", "DARIUS", "DIANA", "DR. MUNDO", "DRAVEN", "EKKO", "ELISE",
        "EVELYNN", "EZREAL", "FIDDLESTICKS", "FIORA", "GALIO", "GANGPLANK", "GAREN", "GNAR", "GRAGAS", "GRAVES",
        "GWEN", "HECARIM", "HEIMERDINGER", "ILLAOI", "IRELIA", "IVERN", "JANNA", "JARVAN IV", "JHIN", "JINX",
        "KAI'SA", "KARMA", "KARTHUS", "KASSADIN", "KATARINA", "KAYLE", "KENNEN", "KHA'ZIX", "KINDRED", "KLED",
        "K'SANTE", "KOG'MAW", "LEBLANC", "LEE SIN", "LEONA", "LILLIA", "LISSANDRA", "LUCIAN", "LULU", "LUX",
        "MALPHITE", "MISS FORTUNE", "MILIO", "MORDEKAISER", "MORGANA", "NAMI", "NASUS", "NAUTILUS", "NEEKO",
        "NILAH", "OLAF", "ORIANA", "PANTHEON", "POPPY", "PYKE", "QIYANA", "RAKAN", "RAMMUS", "REK'SAI", "RENATA GLASC",
        "RENEKTON", "RIVEN", "RUMBLE", "RYZE", "SAMIRA", "SEJUANI", "SENNA", "SETT", "SHACO", "SHEN", "SIVIR",
        "SKARNER", "SONA", "SORAKA", "SWAIN", "SYLAS", "TAHM KENCH", "TALIYAH", "TEEMO", "THRESH", "TRISTANA",
        "TRUNDLE", "TRYNDAMERE", "TWISTED FATE", "TWITCH", "UDYR", "URGOT", "VARUS", "VAYNE", "VEIGAR", "VEL'KOZ",
        "VI", "VIEGO", "VIKTOR", "VLADIMIR", "VOLIBEAR", "WARWICK", "WUKONG", "XAYAH", "YASUO", "YONE",
        "YUUMI", "ZAC", "ZED", "ZERI", "ZILEAN", "ZOE", "ZYRA"
    ];

    private $maxAttempts = 6;

    public function index(Request $request)
    {
        $session = $request->session();
        $today = now()->toDateString();

        // Mantém estado do dia, ou cria se ainda não jogou hoje
        if ($session->has('hangman') && $session->get('hangman.date') === $today) {
            $state = $session->get('hangman');
        } else {
            $word = $this->getDailyWord($today);

            $state = [
                'date' => $today,
                'word' => $word,
                'guessed' => [],
                'wrongLetters' => [],
                'wrong' => 0,
                'maxAttempts' => $this->maxAttempts,
                'lost' => false,
                'won' => false,
                'finished' => false,
            ];

            $session->put('hangman', $state);
        }

        return inertia('RuneterraGuess/Game', [
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'maxAttempts' => $state['maxAttempts'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'finished' => $state['finished'],
            'word' => $state['lost'] ? $state['word'] : null,
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

        return response()->json([
            'displayWord' => $this->getDisplayWord($state),
            'guessed' => $state['guessed'],
            'wrongLetters' => $state['wrongLetters'],
            'wrong' => $state['wrong'],
            'lost' => $state['lost'],
            'won' => $state['won'],
            'finished' => $state['finished'],
            'maxAttempts' => $state['maxAttempts'],
            'word' => $state['lost'] ? $state['word'] : null
        ]);
    }

    private function getDailyWord(string $date): string
    {
        $index = crc32($date) % count($this->words);
        return $this->words[$index];
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
        foreach (str_split($word) as $char) {
            if (!in_array($char, $state['guessed'])) {
                return false;
            }
        }
        return true;
    }
}
