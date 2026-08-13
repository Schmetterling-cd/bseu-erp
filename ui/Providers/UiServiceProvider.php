<?php

namespace UI\Providers;

use Illuminate\Support\ServiceProvider;
use UI\Console\Commands\MergeTranslations;
use UI\Interfaces\TranslationInterface;
use UI\Services\TranslationService;

class UiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TranslationInterface::class, function () {
            return new TranslationService();
        });

        $this->commands([
            MergeTranslations::class,
        ]);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(base_path('routes/ui.php'));

        $this->loadMigrationsFrom([
            database_path('/migrations_ui')
        ]);
    }
}
