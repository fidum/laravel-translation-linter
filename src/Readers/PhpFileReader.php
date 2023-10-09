<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageKeyFactory as LanguageKeyFactoryContract;
use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageNamespaceKeyFactory as LanguageNamespaceKeyFactoryContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class PhpFileReader implements LanguageFileReaderContract, LanguageKeyFactoryContract, LanguageNamespaceKeyFactoryContract
{
    public function getLanguageKey(SplFileInfo $file, string $locale, string $key): string
    {
        return Str::of($file->getPath())
            ->finish(DIRECTORY_SEPARATOR)
            ->after(DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR)
            ->append($file->getFilenameWithoutExtension())
            ->append('.')
            ->append($key)
            ->toString();
    }

    public function getNamespaceHintedKey(SplFileInfo $file, string $locale, string $namespaceHint, string $key): string
    {
        return Str::of($namespaceHint)
            ->whenNotEmpty(fn (Stringable $str) => $str->append('::'))
            ->append($key)
            ->toString();
    }

    public function getTranslations(SplFileInfo $file): array
    {
        $translations = include $file->getPathname();

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return $translations;
    }
}
