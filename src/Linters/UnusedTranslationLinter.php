<?php

namespace Fidum\LaravelTranslationLinter\Linters;

use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter as UnusedTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationLinter\Readers\ApplicationFileReader;
use Fidum\LaravelTranslationLinter\Readers\LanguageFileReader;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Symfony\Component\Finder\SplFileInfo;

readonly class UnusedTranslationLinter implements UnusedTranslationLinterContract
{
    public function __construct(
        protected ApplicationFileReader $used,
        protected LanguageFileFinder $files,
        protected LanguageFileReader $translations,
        protected LanguageNamespaceFinder $namespaces,
        protected array $locales,
    ) {}

    public function execute(): Collection
    {
        $unused = [];
        $used = $this->used->execute();
        $namespaces = $this->namespaces->execute();

        foreach ($this->locales as $locale) {
            $unused[$locale] = [];

            foreach ($namespaces as $namespace => $path) {
                $unused[$locale][$namespace] = [];

                $files = $this->files->execute($path, $locale);

                /** @var SplFileInfo $file */
                foreach ($files as $file) {
                    $translations = $this->translations->execute($file);

                    foreach ($translations as $field => $children) {
                        $group = $this->getLanguageKey($file, $locale, $field);

                        foreach (Arr::dot(Arr::wrap($children)) as $key => $value) {
                            $groupedKey = Str::of($group)
                                ->when(is_string($key), fn (Stringable $str) => $str->append(".$key"))
                                ->toString();

                            $namespacedKey = Str::of($namespace)
                                ->whenNotEmpty(fn (Stringable $str) => $str->append('::'))
                                ->append($groupedKey)
                                ->toString();

                            if ($used->doesntContain($namespacedKey)) {
                                $unused[$locale][$namespace][$groupedKey] = $value;
                            }
                        }
                    }
                }
            }
        }

        return new Collection($unused);
    }

    protected function getLanguageKey(SplFileInfo $file, string $language, string $key): string
    {
        if ($file->getExtension() === 'json') {
            return $key;
        }

        return Str::of($file->getPath())
            ->finish(DIRECTORY_SEPARATOR)
            ->after(DIRECTORY_SEPARATOR.$language.DIRECTORY_SEPARATOR)
            ->append($file->getFilenameWithoutExtension())
            ->append('.')
            ->append($key)
            ->toString();
    }
}
