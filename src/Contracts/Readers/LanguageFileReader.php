<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Readers;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageFileReader
{
    public function getTranslations(SplFileInfo $file): array;
}
