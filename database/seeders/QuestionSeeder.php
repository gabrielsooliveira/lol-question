<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\QuestionTranslation;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'difficulty' => 'easy',
                'region_id' => 1,
                'translations' => [
                    'pt_BR' => [
                        'text' => 'Qual personagem é líder da tribo dos Garras do Inverno?',
                        'correct_answer' => 'Sejuani',
                        'options' => ['Ashe', 'Lissandra', 'Sejuani', 'Olaf'],
                    ],
                    'en' => [
                        'text' => 'Which character is the leader of the Winter Claw tribe?',
                        'correct_answer' => 'Sejuani',
                        'options' => ['Ashe', 'Lissandra', 'Sejuani', 'Olaf'],
                    ],
                ],
            ],
            [
                'difficulty' => 'medium',
                'region_id' => 2,
                'translations' => [
                    'pt_BR' => [
                        'text' => 'Qual é o nome da arma de Tristana?',
                        'correct_answer' => 'Boomer',
                        'options' => ['Pistola de canhão', 'O Treco Sussurrante', 'Canhão de mão', 'Boomer'],
                    ],
                    'en' => [
                        'text' => "What is Tristana's weapon called?",
                        'correct_answer' => 'Boomer',
                        'options' => ['Pistola de canhão', 'O Treco Sussurrante', 'Canhão de mão', 'Boomer'],
                    ],
                ],
            ],
            [
                'difficulty' => 'hard',
                'region_id' => 1,
                'translations' => [
                    'pt_BR' => [
                        'text' => 'Qual é o nome da arma de Tristana?',
                        'correct_answer' => 'Boomer',
                        'options' => ['Pistola de canhão', 'O Treco Sussurrante', 'Canhão de mão', 'Boomer'],
                    ],
                    'en' => [
                        'text' => "What is Tristana's weapon called?",
                        'correct_answer' => 'Boomer',
                        'options' => ['Pistola de canhão', 'O Treco Sussurrante', 'Canhão de mão', 'Boomer'],
                    ],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $question = Question::create([
                'difficulty' => $q['difficulty'],
                'region_id' => $q['region_id']
            ]);

            foreach ($q['translations'] as $locale => $data) {
                QuestionTranslation::create([
                    'question_id' => $question->id,
                    'locale' => $locale,
                    'text' => $data['text'],
                    'correct_answer' => $data['correct_answer'],
                    'options' => json_encode($data['options']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
