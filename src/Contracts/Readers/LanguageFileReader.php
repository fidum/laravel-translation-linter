<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Readers;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageFileReader
{
    public function execute(SplFileInfo $file): array;
}
