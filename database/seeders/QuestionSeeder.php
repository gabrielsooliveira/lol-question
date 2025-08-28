<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'text' => 'Qual é a cidade natal de Jinx e Vi?',
                'correct_answer' => 'Zaun',
                'options' => json_encode(['Zaun', 'Piltover', 'Noxus', 'Demacia']),
                'difficulty' => 'easy',
            ],
            [
                'text' => 'Qual é o nome verdadeiro de LeBlanc?',
                'correct_answer' => 'Inconhecido',
                'options' => json_encode(['Inconhecido', 'Evaine', 'Sylas', 'Camille']),
                'difficulty' => 'medium',
            ],
            [
                'text' => 'Quem é o líder atual de Noxus após a queda de Boram Darkwill?',
                'correct_answer' => 'Jericho Swain',
                'options' => json_encode(['Jericho Swain', 'Darius', 'LeBlanc', 'Vladimir']),
                'difficulty' => 'medium',
            ],
            [
                'text' => 'Qual criatura acompanha Kindred na forma do Lobo?',
                'correct_answer' => 'O Lobo',
                'options' => json_encode(['O Lobo', 'O Corvo', 'O Gato', 'O Dragão']),
                'difficulty' => 'easy',
            ],
            [
                'text' => 'Qual é a relação entre Yasuo e Yone?',
                'correct_answer' => 'São irmãos',
                'options' => json_encode(['São irmãos', 'São rivais sem parentesco', 'São primos', 'São mestre e aprendiz']),
                'difficulty' => 'easy',
            ],
            [
                'text' => 'Quem foi o criador original de Blitzcrank?',
                'correct_answer' => 'Viktor',
                'options' => json_encode(['Viktor', 'Heimerdinger', 'Jayce', 'Singed']),
                'difficulty' => 'medium',
            ],
            [
                'text' => 'Qual é a origem de Aatrox, Rhaast e Varus?',
                'correct_answer' => 'São Darkin',
                'options' => json_encode(['São Darkin', 'São Ascendentes de Shurima', 'São Vastaya', 'São Yordles']),
                'difficulty' => 'hard',
            ],
            [
                'text' => 'Qual região é conhecida por venerar os Aspectos celestiais?',
                'correct_answer' => 'Targon',
                'options' => json_encode(['Targon', 'Ionia', 'Freljord', 'Bilgewater']),
                'difficulty' => 'easy',
            ],
            [
                'text' => 'Qual é a relação de Rell com Noxus?',
                'correct_answer' => 'Foi usada como arma viva',
                'options' => json_encode(['Foi usada como arma viva', 'É general de Noxus', 'Foi campeã de arenas', 'É filha de Swain']),
                'difficulty' => 'medium',
            ],
            [
                'text' => 'Quem é o protetor espiritual de Ionia conhecido como o Olho do Crepúsculo?',
                'correct_answer' => 'Shen',
                'options' => json_encode(['Shen', 'Zed', 'Kennen', 'Akali']),
                'difficulty' => 'easy',
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
