<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class LanguageFileReader implements LanguageFileReaderContract
{
    public function execute(SplFileInfo $file): array
    {
        $translations = match ($file->getExtension()) {
            'json' => json_decode($file->getContents(), true),
            default => include $file->getPathname(),
        };

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return $translations;
    }
}
