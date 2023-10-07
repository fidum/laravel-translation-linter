<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class JsonFileReader implements LanguageFileReaderContract
{
    public function getTranslations(SplFileInfo $file): array
    {
        $translations = json_decode($file->getContents(), true);

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return $translations;
    }
}
