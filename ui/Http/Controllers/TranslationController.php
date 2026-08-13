<?php

namespace UI\Http\Controllers;

use App\Http\Controllers\Controller;
use UI\Interfaces\TranslationInterface;

class TranslationController extends Controller
{
    public function getTranslations(TranslationInterface $service, $locale)
    {
        return $service->getTranslation($locale);
    }
}
