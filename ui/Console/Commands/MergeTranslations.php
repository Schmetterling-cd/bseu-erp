<?php
// UI/Console/Commands/MergeTranslations.php

namespace UI\Console\Commands;

use Illuminate\Console\Command;
use UI\Interfaces\TranslationInterface;

class MergeTranslations extends Command
{
    protected $signature = 'translations:merge
                            {--locale= : Merge for specific locale (e.g., ru)}
                            {--force : Force regenerate even if files exist}';

    protected $description = 'Merge translations from PHP files and database into JSON files in lang directory';

    public function handle(TranslationInterface $service): int
    {
        $locale = $this->option('locale');
        $force = $this->option('force');

        try {
            $service->generateTranslations($force,$locale);

            $this->info("\n✅ All translations merged successfully!");
            $this->info("📁 JSON files saved in: " . base_path('lang'));

            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->error($e->getTraceAsString());
            return 1;
        }
    }
}
