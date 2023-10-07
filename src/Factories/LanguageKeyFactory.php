<?php

namespace Fidum\LaravelTranslationLinter\Factories;

use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageKeyFactory as LanguageKeyFactoryContract;
use Fidum\LaravelTranslationLinter\Managers\LanguageFileReaderManager;
use Symfony\Component\Finder\SplFileInfo;

class LanguageKeyFactory implements LanguageKeyFactoryContract
{
    public function __construct(protected LanguageFileReaderManager $manager) {}

    public function getLanguageKey(SplFileInfo $file, string $locale, string $key): string
    {
        $extension = $file->getExtension();

        if ($this->manager->isEnabled($extension)) {
            $reader = $this->manager->driver($extension);

            if ($reader instanceof LanguageKeyFactoryContract) {
                return $reader->getLanguageKey($file, $locale, $key);
            }
        }

        return $key;
    }
}
