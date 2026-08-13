<?php

namespace UI\Interfaces;

interface TranslationInterface
{
    public function getTranslation(string $locale): \Illuminate\Http\Response;
    public  function generateTranslations(bool $force = false, ?string $locale = null): void;

}
