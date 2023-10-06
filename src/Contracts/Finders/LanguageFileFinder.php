<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Finders;

use Illuminate\Support\Collection;

interface LanguageFileFinder
{
    public function execute(string $path, string $locale): Collection;
}
