<?php

namespace UI\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use UI\Interfaces\TranslationInterface;
use UI\Jobs\GenerateTranslationsJob;

class TranslationService implements TranslationInterface
{
    public function getTranslation($locale): \Illuminate\Http\Response
    {
        $jsonPath = base_path("lang/{$locale}.json");

        if (!File::exists($jsonPath)) {
            $this->generateTranslations(false, $locale);
        }

        if (!File::exists($jsonPath)) {
            throw new \Exception("Translation file not found in: {$jsonPath}");
        }

        return response(File::get($jsonPath), 200)->header('Content-Type', 'application/json');
    }

    /**
     * Объединить переводы
     *
     * @param string|null $locale - конкретная локаль или null для всех
     * @param bool $force - принудительная перезапись
     */
    public function generateTranslations(bool $force = false, ?string $locale = null): void
    {
        $phpTranslations = $this->loadPhpTranslations($force, $locale);
        $dbTranslations = $this->loadDbTranslations($force, $locale);

        $allLocales = array_unique(
            array_merge(
                array_keys($phpTranslations),
                array_keys($dbTranslations)
            )
        );

        foreach ($allLocales as $loc) {
            $php = $phpTranslations[$loc] ?? [];
            $db = $dbTranslations[$loc] ?? [];
            $merged = array_replace_recursive($php, $db);
            $this->saveJsonFile($loc, $merged, $force);
        }
    }

    private function loadPhpTranslations(bool $force, ?string $locale = null): array
    {
        $translations = [];

        // Если указана конкретная локаль
        if ($locale) {
            $locales = [$locale];
        } else {
            // Получаем все локали из папки lang
            $langPath = base_path('lang');
            if (!is_dir($langPath)) {
                return [];
            }

            // Собираем локали из папок и JSON файлов
            $locales = [];
            $directories = array_filter(glob($langPath . '/*'), 'is_dir');
            foreach ($directories as $dir) {
                $locales[] = basename($dir);
            }

            $jsonFiles = glob($langPath . '/*.json');
            foreach ($jsonFiles as $file) {
                $loc = pathinfo($file, PATHINFO_FILENAME);
                if (!in_array($loc, $locales)) {
                    $locales[] = $loc;
                }
            }
        }

        // Загружаем переводы для каждой локали
        foreach ($locales as $loc) {
            $langPath = base_path("lang/{$loc}");

            if (!is_dir($langPath)) {
                continue;
            }

            $files = glob($langPath . '/*.php');

            foreach ($files as $file) {
                $group = pathinfo($file, PATHINFO_FILENAME);
                $translations[$loc][$group] = include $file;
            }
        }

        return $translations;
    }

    private function loadDbTranslations(bool $force = true, ?string $locale = null): array
    {
        $translations = [];

        DB::table('language_lines')
            ->orderBy('id')
            ->chunk(100, function ($chunk) use ($force, $locale, &$translations) {
                foreach ($chunk as $line) {
                    $texts = json_decode($line->text, true);

                    switch (true) {
                        case $force:
                            foreach ($texts as $loc => $text) {
                                $translations[$loc][$line->group][$line->key] = $text;
                            }
                            break;
                        case isset($texts[$locale]):
                            $translations[$locale][$line->group][$line->key] = $texts[$locale];
                            break;
                    }
                }
            });

        return $translations;
    }

    private function saveJsonFile(string $locale, array $translations, bool $force = false): void
    {
        $jsonPath = base_path("lang/{$locale}.json");

        if (File::exists($jsonPath) && !$force) {
            throw new \RuntimeException(
                "File {$locale}.json already exists. Use --force to overwrite."
            );
        }

        $sorted = $this->sortRecursive($translations);

        $json = json_encode($sorted, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if (file_put_contents($jsonPath, $json) === false) {
            throw new \RuntimeException("Failed to write JSON file: {$jsonPath}");
        }
    }

    private function sortRecursive(array $array): array
    {
        ksort($array);

        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = $this->sortRecursive($value);
            }
        }

        return $array;
    }

    public function generateTranslationsAsync(bool $force = false, ?string $locale = null): void
    {
        $job = new GenerateTranslationsJob($force, $locale);
        dispatch($job)->onQueue('translations');
    }
}
