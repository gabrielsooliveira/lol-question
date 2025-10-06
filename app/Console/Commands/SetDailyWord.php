<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RuneterraWord;
use App\Models\DailyWord;

class SetDailyWord extends Command
{
    protected $signature = 'runeterra:set-daily-word';
    protected $description = 'Define a palavra do dia de WordLoL';

    public function handle(): void
    {
        $today = now()->setTimezone('America/Sao_Paulo')->toDateString();

        if (DailyWord::where('date', $today)->exists()) {
            $this->info("Palavra do dia já definida para {$today}");
            return;
        }

        $word = RuneterraWord::inRandomOrder()->first();

        DailyWord::create([
            'date' => $today,
            'runeterra_word_id' => $word->id,
        ]);

        $this->info("Palavra do dia definida: {$word->name}");
    }
}
