<?php

namespace App\Http\Controllers\LoreQuestion;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Services\GameSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleplayController extends Controller
{
    public function roleplay(Request $request)
    {
        $validated = $request->validate([
            'difficulty' => 'required|string|in:easy,medium,hard',
        ]);

        GameSessionService::setGameSettings($validated);

        return inertia('LoreQuestion/Game');
    }

    public function startGame()
    {
        $settings = GameSessionService::getGameSettings();

        $questions = Question::with('region')
            ->where('difficulty', $settings['difficulty'])
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return response()->json([
            'questions' => $questions->map(fn($q) => [
                'id' => $q->id,
                'text' => $q->text,
                'options' => collect(json_decode($q->options, true))->shuffle(),
                'region' => optional($q->region)->name,
            ]),
        ]);
    }

    public function finishGame(Request $request)
    {
        $validated = $request->validate([
            'respostas' => 'required|array',
            'respostas.*.question_id' => 'required|integer',
            'respostas.*.answer' => 'required|string',
        ]);

        $correct = 0;
        $wrong = [];
        $totalQuestions = count($validated['respostas']);

        // Fetch all questions answered by the user in a single query
        $questionIds = collect($validated['respostas'])->pluck('question_id');
        $questions = Question::whereIn('id', $questionIds)->get()->keyBy('id');

        foreach ($validated['respostas'] as $resp) {
            $question = $questions->get($resp['question_id']);
            if (!$question) continue;

            if ($question->correct_answer === $resp['answer']) {
                $correct++;
            } else {
                $wrong[] = [
                    'question_text' => $question->text,
                    'user_answer' => $resp['answer'] === 'timeout' ? 'Tempo esgotado' : $resp['answer'],
                    'correct_answer' => $question->correct_answer,
                ];
            }
        }

        return response()->json([
            'total_questions' => $totalQuestions,
            'correct_answers' => $correct,
            'wrong_answers' => $wrong,
        ]);
    }
}
