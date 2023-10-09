<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Factories;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageNamespaceKeyFactory
{
    public function getNamespaceHintedKey(SplFileInfo $file, string $locale, string $namespaceHint, string $key): string;
}
