<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Gera o arquivo sitemap.xml do site HextechPlay';

    public function handle(): void
    {
        $this->info('Gerando sitemap...');

        Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/games'))
            ->add(Url::create('/partners'))
            ->add(Url::create('/contact'))
            ->add(Url::create('/lorequestion'))
            ->add(Url::create('/lorequestion/roleplay'))
            ->add(Url::create('/wordlol'))
            ->add(Url::create('/privacy-policy'))
            ->add(Url::create('/terms'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap gerado com sucesso em public/sitemap.xml');
    }
}
