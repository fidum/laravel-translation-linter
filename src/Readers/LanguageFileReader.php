<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationLinter\Managers\LanguageFileReaderManager;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class LanguageFileReader implements LanguageFileReaderContract
{
    public function __construct(protected LanguageFileReaderManager $manager) {}

    public function execute(SplFileInfo $file): array
    {
        $extension = $file->getExtension();
        $translations = [];

        if ($this->manager->isEnabled($extension)) {
            $translations = $this->manager->driver($extension)->execute($file);

            if (! $translations) {
                throw new InvalidArgumentException("Unable to extract any data from {$file->getPathname()}!");
            }
        }

        return $translations;
    }
}
