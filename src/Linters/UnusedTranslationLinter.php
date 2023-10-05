<?php

namespace Fidum\LaravelTranslationLinter\Linters;

use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter as UnusedTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Extractors\Extractor;
use Fidum\LaravelTranslationLinter\Finders\LanguageNamespaceFinder;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Symfony\Component\Finder\SplFileInfo;

class UnusedTranslationLinter implements UnusedTranslationLinterContract
{
    public function __construct(
        protected Extractor $extractor,
        protected LanguageFileFinder $finder,
        protected LanguageNamespaceFinder $namespaces,
        protected array $languages = ['en'],
    ) {
    }

    public function execute(): Collection
    {
        $unusedStrings = [];
        $usedStrings = $this->extractor->execute()->toArray();
        $registeredNamespaces = $this->namespaces->execute();

        foreach ($this->languages as $language) {
            $unusedStrings[$language] = [];

            foreach ($registeredNamespaces as $namespace => $path) {
                $unusedStrings[$language][$namespace] = [];

                // TODO: Support json files
                $files = $this->finder->execute($path, ['php']);

                /** @var SplFileInfo $file */
                foreach ($files as $file) {
                    $translations = $this->getTranslationsFromFile($file);

                    foreach ($translations as $field => $value) {
                        $group = $this->getLanguageKey($file, $language, $field);
                        foreach (Arr::dot(Arr::wrap($value)) as $key => $val) {
                            $groupedKey = Str::of($group)
                                ->when(is_string($key), fn (Stringable $str) => $str->append(".$key"))
                                ->toString();

                            $namespacedKey = Str::of($namespace)
                                ->whenNotEmpty(fn (Stringable $str) => $str->append('::'))
                                ->append($groupedKey)
                                ->toString();

                            if (! in_array($namespacedKey, $usedStrings)) {
                                $unusedStrings[$language][$namespace][$groupedKey] = $val;
                            }
                        }
                    }
                }
            }
        }

        return new Collection($unusedStrings);
    }

    public function withLanguages(array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    protected function getLanguageKey(SplFileInfo $file, string $language, string $key): string
    {
        if ($file->getExtension() === 'json') {
            return $key;
        }

        return Str::of($file->getPath())
            ->finish('/')
            ->after("/$language/")
            ->append($file->getFilenameWithoutExtension())
            ->append('.')
            ->append($key)
            ->toString();
    }

    protected function getTranslationsFromFile(SplFileInfo $file): array
    {
        $translations = include $file->getPathname();

        if ($file->getExtension() === 'json') {
            $translations = json_decode($translations, true);
        }

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return $translations;
    }
}
