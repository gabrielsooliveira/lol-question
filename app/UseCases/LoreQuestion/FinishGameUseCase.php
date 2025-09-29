<?php

namespace App\UseCases\LoreQuestion;

use App\DTOs\AnswerDTO;
use App\DTOs\GameResultDTO;
use App\Repositories\Eloquent\QuestionRepository;

class FinishGameUseCase
{
    public function __construct(
        protected QuestionRepository $questionRepository
    ) {}

    /**
     * @param AnswerDTO[] $answers
     */
    public function execute(array $answers, string $locale): GameResultDTO
    {
        $uuids = collect($answers)->pluck('questionId')->toArray();
        $questions = $this->questionRepository->getQuestionsWithTranslations($uuids, $locale);

        $correct = [];
        $wrong = [];

        foreach ($answers as $answerDTO) {
            $question = $questions->get($answerDTO->questionId);
            if (!$question) {
                continue;
            }

            $translation = $question->translations->first();
            if (!$translation) {
                continue;
            }

            $userAnswer = $answerDTO->answer === 'timeout' ? 'timeout' : $answerDTO->answer;

            $item = [
                'question_id'    => $answerDTO->questionId,
                'question_text'  => $translation->text,
                'user_answer'    => $userAnswer,
                'correct_answer' => $translation->correct_answer,
            ];

            if ($translation->correct_answer === $answerDTO->answer) {
                $correct[] = $item;
            } else {
                $wrong[] = $item;
            }
        }

        return new GameResultDTO(
            totalQuestions: count($answers),
            correctAnswers: $correct,
            wrongAnswers: $wrong
        );
    }
}

