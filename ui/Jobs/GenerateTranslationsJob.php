<?php
// UI/Jobs/GenerateTranslationsJob.php

namespace UI\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use UI\Services\TranslationService;

class GenerateTranslationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;
    public $tries = 3;

    public $jobId;

    public function __construct(
        protected bool $force = false,
        protected ?string $locale = null,
    ) {
        $this->jobId = Str::uuid();
    }

    public function handle(TranslationService $translationService): void
    {
        $translationService->generateTranslations($this->force, $this->locale);
    }
}
