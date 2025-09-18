<?php

namespace App\Http\Controllers\LoreQuestion;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Services\GameSessionService;
use Illuminate\Http\Request;

class RoleplayController extends Controller
{
    public function roleplay(Request $request)
    {
        $validated = $request->validate([
            'difficulty' => 'required|string|in:easy,medium,hard',
            'questionQuant' => 'required|integer|min:1|max:10',
        ]);

        GameSessionService::setGameSettings($validated);

        return inertia('LoreQuestion/Game');
    }

    public function startGame()
    {
        $settings = GameSessionService::getGameSettings();
        $locale = app()->getLocale();

        $questions = Question::with('translations')
            ->where('difficulty', $settings['difficulty'])
            ->inRandomOrder()
            ->limit($settings['questionQuant'])
            ->get()
            ->map(fn($question) => $question->getLocalizedData($locale));

        return response()->json([
            'questions' => $questions
        ]);
    }

    public function finishGame(Request $request)
    {
        $validated = $request->validate([
            'respostas' => 'required|array',
            'respostas.*.question_id' => 'required|integer',
            'respostas.*.answer' => 'required|string',
        ]);

        $correct = [];
        $wrong = [];
        $totalQuestions = count($validated['respostas']);

        $questionIds = collect($validated['respostas'])->pluck('question_id');
        $questions = QuestionTranslation::whereIn('id', $questionIds)->get()->keyBy('id');

        foreach ($validated['respostas'] as $resp) {
            $question = $questions->get($resp['question_id']);
            if (!$question) continue;

            if ($question->correct_answer === $resp['answer']) {
                $correct[] = [
                    'question_text' => $question->text,
                    'user_answer' => $resp['answer'] === 'timeout' ? 'Tempo esgotado' : $resp['answer'],
                    'correct_answer' => $question->correct_answer,
                ];
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
