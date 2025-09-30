<?php

namespace App\Providers;

use App\Repositories\Eloquent\QuestionRepository;
use App\Repositories\Interface\QuestionRepositoryInterface;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        Inertia::share([
            'locale' => fn () => app()->getLocale(),
            'translations' => fn () => [
                'page' => function () {
                    $routeName = request()->route()->getName();
                    $filename = str_replace('.', '_', $routeName);
                    return Lang::has($filename) ? Lang::get($filename) : [];
                },
            ],
        ]);
    }
}
