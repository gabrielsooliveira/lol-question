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
                'text' => 'Qual personagem é líder da tribo dos Garras do Inverno?',
                'correct_answer' => 'Sejuani',
                'options' => json_encode(['Ashe', 'Lissandra', 'Sejuani', 'Olaf']),
                'difficulty' => 'easy',
                'region_id' => 4,
            ],
            [
                'text' => 'Qual é o nome da arma de Tristana?',
                'correct_answer' => 'Boomer',
                'options' => json_encode(['Pistola de canhão', 'O Treco Sussurrante', 'Canhão de mão', 'Boomer']),
                'difficulty' => 'easy',
                'region_id' => 2,
            ],
            [
                'text' => 'Qual campeão é um ladrão e vigarista que vive de apostas e truques em Águas de Sentina?',
                'correct_answer' => 'Twisted Fate',
                'options' => json_encode(['Graves', 'Pyke', 'Twisted Fate', 'Nautilus']),
                'difficulty' => 'easy',
                'region_id' => 1,
            ],
            [
                'text' => 'Qual é a moeda local de Águas de Sentina?',
                'correct_answer' => 'Serpente de Prata',
                'options' => json_encode(['Serpente de Prata', 'Moeda de ouro', 'Pedra de fogo', 'Escama de dragão']),
                'difficulty' => 'medium',
                'region_id' => 1,
            ],
            [
                'text' => 'Qual região de Runeterra é o lar de Garen e da Vanguarda Destemida, e é conhecida por sua estrita tradição militar e por sua perseguição àqueles que praticam magia?',
                'correct_answer' => 'Demacia',
                'options' => json_encode(['Ionia', 'Demacia', 'Noxus', 'Freljord']),
                'difficulty' => 'easy',
                'region_id' => 3
            ],
            [
                'text' => 'Qual personagem subiu o monte targon e foi escolhido(a) como receptáculo do aspecto da justiça?',
                'correct_answer' => 'Mihira',
                'options' => json_encode(['Mihira', 'Morgana', 'Kayle', 'Leona']),
                'difficulty' => 'medium',
                'region_id' => 11
            ],
            [
                'text' => 'Após ser exilado(a) de Noxus por se opor aos métodos doentios de guerra, qual personagem busca redenção e uma nova vida em uma região pacífica conhecida pela busca do equilíbrio espiritual?',
                'correct_answer' => 'Riven',
                'options' => json_encode(['Darius', 'Katarina', 'Riven', 'Talon']),
                'difficulty' => 'medium',
                'region_id' => 6
            ],
            [
                'text' => 'O Monte Targon é a mais imponente montanha de Runeterra, um local onde pessoas são testadas e, se forem dignas, podem se tornar os Avatares das constelações. Qual personagem ascendeu para se tornar o Aspecto do Sol?',
                'correct_answer' => 'Leona',
                'options' => json_encode(['Zoe', 'Leona', 'Taric', 'Pantheon']),
                'difficulty' => 'medium',
                'region_id' => 11
            ],
            [
                'text' => 'Qual personagem é um ex-membro do Clã Ferreiro, se tornou um ser ancestral poderoso e é adorado como um deus da forja por alguns, mas se mantém isolado no coração de uma montanha no Freljord?',
                'correct_answer' => 'Ornn',
                'options' => json_encode(['Volibear', 'Braum', 'Olaf', 'Ornn']),
                'difficulty' => 'hard',
                'region_id' => 4
            ],
            [
                'text' => 'Qiyana, a Imperatriz dos Elementos, governa sobre qual região?',
                'correct_answer' => 'Ixtal',
                'options' => json_encode(['Shurima', 'Ixtal', 'Targon', 'Freljord']),
                'difficulty' => 'easy',
                'region_id' => 7
            ],
            [
                'text' => 'Darius e Swain são líderes militares influentes de qual região?',
                'correct_answer' => 'Noxus',
                'options' => json_encode(['Noxus', 'Demacia', 'Piltover', 'Águas de Sentina']),
                'difficulty' => 'easy',
                'region_id' => 8
            ],
            [
                'text' => 'Em Freljord, a Guerra das Três Irmãs dividiu a região em facções. Quais irmãs protagonizaram esse conflito?',
                'correct_answer' => 'Avarosa, Serylda e Lissandra',
                'options' => json_encode(['Sejuani, Ashe e Lissandra', 'Avarosa, Serylda e Lissandra', 'Anivia, Ashe e Tryndamere', 'Serylda, Ashe e Anivia']),
                'difficulty' => 'medium',
                'region_id' => 4,
            ],
            [
                'text' => 'Qual personagem sugere que lux se case com Jarvan IV para que ela fique a salvo da perseguição por sua magia?',
                'correct_answer' => 'Tianna',
                'options' => json_encode(['Tianna', 'Fiora', 'Garen', 'Jarvan III']),
                'difficulty' => 'hard',
                'region_id' => 3,
            ],
            [
                'text' => 'Qual ordem demaciana é encarregada de conter a magia dentro do país?',
                'correct_answer' => 'Tianna',
                'options' => json_encode(['Caçadores de Magos', 'Trifarix', 'Vanguarda Intrépida', 'Vanguarda Destemida']),
                'difficulty' => 'easy',
                'region_id' => 3,
            ],
            [
                'text' => 'Darius e seu irmão Draven cresceram em qual cidade portuária de Noxus?',
                'correct_answer' => 'Basilich',
                'options' => json_encode(['Basilich', 'Noxus', 'Demacia', 'Freljord']),
                'difficulty' => 'easy',
                'region_id' => 8,
            ],
            [
                'text' => 'Qual comandante noxiano reconheceu a força de Darius e seu irmão, recrutando-os para o exército?',
                'correct_answer' => 'Cyrus',
                'options' => json_encode(['Cyrus', 'Boram Darkwill', 'Swain', 'Draven']),
                'difficulty' => 'medium',
                'region_id' => 8,
            ],
            [
                'text' => 'Em qual batalha Darius decapitou um general noxiano para evitar a retirada das tropas?',
                'correct_answer' => 'Batalha das Planícies de Dalamor',
                'options' => json_encode(['Batalha das Planícies de Dalamor', 'Cerco de Placidium', 'Batalha de Basilich', 'Guerra das Três Irmãs']),
                'difficulty' => 'hard',
                'region_id' => 8,
            ],
            [
                'text' => 'Após a vitória contra os Varju, que título Darius recebeu do imperador Boram Darkwill?',
                'correct_answer' => 'Mão de Noxus',
                'options' => json_encode(['Mão de Noxus', 'Lâmina de Noxus', 'Punho de Noxus', 'Braço de Noxus']),
                'difficulty' => 'medium',
                'region_id' => 8,
            ],
            [
                'text' => 'Quem liderou o golpe que resultou na morte do imperador Boram Darkwill?',
                'correct_answer' => 'Jericho Swain',
                'options' => json_encode(['Jericho Swain', 'Boram Darkwill', 'Darius', 'LeBlanc']),
                'difficulty' => 'medium',
                'region_id' => 8,
            ],
            [
                'text' => 'Após o golpe, Darius decidiu apoiar qual novo líder de Noxus?',
                'correct_answer' => 'Jericho Swain',
                'options' => json_encode(['Jericho Swain', 'Boram Darkwill', 'LeBlanc', 'Draven']),
                'difficulty' => 'medium',
                'region_id' => 8,
            ],
            [
                'text' => 'Com a formação do Trifarix, Darius assumiu qual princípio de força?',
                'correct_answer' => 'Poder',
                'options' => json_encode(['Poder', 'Visão', 'Astúcia', 'Sabedoria']),
                'difficulty' => 'hard',
                'region_id' => 8,
            ],
            [
                'text' => 'Qual legião Darius fundou para representar a elite militar de Noxus?',
                'correct_answer' => 'Legião Trifariana',
                'options' => json_encode(['Legião Trifariana', 'Legião de Ferro', 'Legião de Honra', 'Legião Sombria']),
                'difficulty' => 'hard',
                'region_id' => 8,
            ],
            [
                'text' => 'Em qual região Darius foi enviado para subjugar as tribos bárbaras?',
                'correct_answer' => 'Freljord',
                'options' => json_encode(['Freljord', 'Demacia', 'Ionia', 'Shurima']),
                'difficulty' => 'medium',
                'region_id' => 8,
            ],
            [
                'text' => 'Durante a campanha em Freljord, Darius enfrentou qual tribo feroz?',
                'correct_answer' => 'Garra do Inverno',
                'options' => json_encode(['Garra do Inverno', 'Garras de Freljord', 'Garras do Norte', 'Garras de Noxus']),
                'difficulty' => 'hard',
                'region_id' => 8,
            ],

        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
