<?php

return [
    'page_title' => 'WordLoL - Adivinhe a palavra de League of Legends!',
    'page_description' => 'Jogue WordLoL, um divertido jogo de adivinhar palavras baseado no universo de League of Legends. Tente adivinhar a palavra secreta com dicas e um número limitado de tentativas!',
    'title' => 'WordLoL',
    'attempts' => 'TENTATIVAS',
    'remaining' => 'CHANCES RESTANTES',
    'status' => [
        'won' => '🎉 Parabéns! Você ganhou!',
        'lost' => '😢 Você perdeu!',
        'lost_word' => 'A palavra era:',
        'playing' => 'Digite uma letra ou tente a palavra completa',
    ],
    "share_result" => "Compartilhar Resultado",
    'share' => [
        'won' => "Acertei {score} letras na palavra! Difícil!",
        "lost" => "Não consegui! A palavra era: {word}",
        "unsupported" => "Compartilhamento não suportado neste navegador."
    ],
    'input' => [
        'placeholder' => 'Digite letra ou palavra',
        'button_try' => '✅ Tentar',
        'button_loading' => '⏳',
        'error_invalid' => 'Digite apenas letras!',
        'error_repeat' => 'Você já tentou esta letra!',
        'error_generic' => 'Erro ao processar tentativa. Tente novamente.',
    ],
    'wrong_letters' => [
        'title' => '❌ Letras Erradas',
        'none' => 'Nenhuma ainda',
    ],
    'guide' => [
        'title' => 'Como Jogar WordLoL',
        'item1' => 'Tente adivinhar a palavra antes de atingir o número máximo de erros.',
        'item2' => 'Digite uma letra por vez ou tente adivinhar a palavra inteira.',
        'item3' => 'Palavras já tentadas não podem ser repetidas.',
        'item4' => 'Compartilhe seus resultados no Twitter ao finalizar.',
        'item5' => 'Você tem um tempo limitado para cada palavra, fique atento!',
    ],
];
