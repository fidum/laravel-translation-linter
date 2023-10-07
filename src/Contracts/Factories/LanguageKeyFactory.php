<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Factories;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageKeyFactory
{
    public function getLanguageKey(SplFileInfo $file, string $locale, string $key): string;
}
