<?php

namespace Fidum\LaravelTranslationLinter\Factories;

use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageNamespaceKeyFactory as LanguageNamespaceKeyFactoryContract;
use Fidum\LaravelTranslationLinter\Managers\LanguageFileReaderManager;
use Symfony\Component\Finder\SplFileInfo;

class LanguageNamespaceKeyFactory implements LanguageNamespaceKeyFactoryContract
{
    public function __construct(protected LanguageFileReaderManager $manager) {}

    public function getNamespaceHintedKey(SplFileInfo $file, string $locale, string $namespaceHint, string $key): string
    {
        $extension = $file->getExtension();

        if ($this->manager->isEnabled($extension)) {
            $reader = $this->manager->driver($extension);

            if ($reader instanceof LanguageNamespaceKeyFactoryContract) {
                return $reader->getNamespaceHintedKey($file, $locale, $namespaceHint, $key);
            }
        }

        return $key;
    }
}
