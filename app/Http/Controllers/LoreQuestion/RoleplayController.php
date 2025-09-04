<?php

namespace App\Http\Controllers\LoreQuestion;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleplayController extends Controller
{
    public function roleplay()
    {
        Session::forget('answered_questions');
        Session::forget('game_state');
        return inertia('LoreQuestion/Game');
    }

    public function startGame()
    {
        $answeredQuestions = Session::get('answered_questions', []);

        $question = Question::whereNotIn('id', $answeredQuestions)->inRandomOrder()->first();

        if (!$question) {
            return response()->json(['finished' => true]);
        }

        $answeredQuestions[] = $question->id;
        Session::put('answered_questions', $answeredQuestions);

        $options = collect(json_decode($question->options, true))->shuffle();

        return response()->json([
            'id' => $question->id,
            'text' => $question->text,
            'options' => $options
        ]);
    }

    public function submitAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|integer|exists:questions,id',
            'answer' => 'required|string',
        ]);

        $question = Question::findOrFail($request->question_id);

        // Verifica se a resposta enviada é "timeout"
        $isCorrect = $question->correct_answer === $request->answer;
        $isTimeout = $request->answer === 'timeout';

        $gameState = Session::get('game_state', [
            'total_questions' => 0,
            'correct_answers' => 0,
            'wrong_answers' => [],
        ]);

        $gameState['total_questions']++;

        if ($isCorrect) {
            $gameState['correct_answers']++;
        } else {
            // Se a resposta for um "timeout", salva uma mensagem específica
            $userAnswer = $isTimeout ? 'Tempo esgotado' : $request->answer;

            $gameState['wrong_answers'][] = [
                'question_text' => $question->text,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
            ];
        }

        Session::put('game_state', $gameState);

        return response()->json([
            'is_correct' => $isCorrect,
            'finished' => $gameState['total_questions'] >= 5,
            'results' => ($gameState['total_questions'] >= 5) ? $gameState : null,
        ]);
    }
}
