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
        $translations = trans('roleplayLorequestion');
        $validated = $request->validate([
            'difficulty' => 'required|string|in:easy,medium,hard',
            'questionQuant' => 'required|integer|min:1|max:10',
        ]);

        GameSessionService::setGameSettings($validated);

        return inertia('LoreQuestion/Game', [
            'translations' => $translations
        ]);
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
            'respostas.*.question_id' => 'required|string',
            'respostas.*.answer' => 'required|string',
        ]);

        $correct = [];
        $wrong = [];
        $totalQuestions = count($validated['respostas']);

        // Locale atual do sistema
        $locale = app()->getLocale();

        // pega todos os UUIDs enviados
        $uuids = collect($validated['respostas'])->pluck('question_id');

        // carrega as perguntas + traduções no locale ativo
        $questions = Question::with(['translations' => function($q) use ($locale) {
                $q->where('locale', $locale)
                ->select('question_id', 'locale', 'text', 'correct_answer', 'options');
            }])
            ->whereIn('uuid', $uuids)
            ->get()
            ->keyBy('uuid');

        foreach ($validated['respostas'] as $resp) {
            $question = $questions->get($resp['question_id']);
            if (!$question) continue;

            // só terá 1 tradução por conta do where no eager loading
            $translation = $question->translations->first();
            if (!$translation) continue;

            $userAnswer = $resp['answer'] === 'timeout' ?'timeout' : $resp['answer'];

            if ($translation->correct_answer === $resp['answer']) {
                $correct[] = [
                    'question_text' => $translation->text,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $translation->correct_answer,
                ];
            } else {
                $wrong[] = [
                    'question_text' => $translation->text,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $translation->correct_answer,
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
