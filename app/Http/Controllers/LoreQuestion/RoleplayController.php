<?php

namespace App\Http\Controllers\LoreQuestion;

use App\DTOs\AnswerDTO;
use App\DTOs\GameSettingsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoreQuestion\AwserRequest;
use App\Http\Requests\LoreQuestion\SettingsRequest;
use App\UseCases\LoreQuestion\FinishGameUseCase;
use App\UseCases\LoreQuestion\StartRoleplayGameUseCase;
use App\UseCases\LoreQuestion\StartGameUseCase;
use Illuminate\Http\JsonResponse;

class RoleplayController extends Controller
{
    public function __construct(
        protected FinishGameUseCase $finishGameUseCase,
        protected StartRoleplayGameUseCase $startRoleplayGame,
        protected StartGameUseCase $startGame
    ) {}

    public function roleplay(SettingsRequest $request)
    {
        $settings = GameSettingsDTO::fromArray($request->validated());
        $this->startRoleplayGame->execute($settings);

        return inertia('LoreQuestion/Game');
    }

    public function startGame(): JsonResponse
    {
        $locale = app()->getLocale();
        $questions = $this->startGame->execute($locale);

        return response()->json([
            'questions' => $questions
        ]);
    }

    public function finishGame(AwserRequest $request, FinishGameUseCase $useCase)
    {
        $locale = app()->getLocale();

        $answers = collect($request->validated('answers'))
            ->map(fn($resp) => AnswerDTO::fromArray($resp))
            ->toArray();

        $result = $useCase->execute($answers, $locale);

        return response()->json($result->toArray());
    }
}
