<?php

namespace Fidum\LaravelTranslationLinter\Linters;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;
use Fidum\LaravelTranslationLinter\Contracts\Factories\LanguageKeyFactory;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter as UnusedTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader;
use Fidum\LaravelTranslationLinter\Contracts\Readers\LanguageFileReader;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Symfony\Component\Finder\SplFileInfo;

readonly class UnusedTranslationLinter implements UnusedTranslationLinterContract
{
    public function __construct(
        protected ApplicationFileReader $used,
        protected LanguageFileFinder $files,
        protected LanguageFileReader $translations,
        protected LanguageKeyFactory $factory,
        protected LanguageNamespaceFinder $namespaces,
        protected ResultObjectCollection $results,
        protected array $locales,
    ) {}

    public function execute(): ResultObjectCollection
    {
        $this->results->reset();
        $used = $this->used->execute();
        $namespaces = $this->namespaces->execute();

        foreach ($this->locales as $locale) {
            foreach ($namespaces as $namespace => $path) {
                $files = $this->files->execute($path, $locale);

                /** @var SplFileInfo $file */
                foreach ($files as $file) {
                    $translations = $this->translations->getTranslations($file);

                    foreach ($translations as $field => $children) {
                        $group = $this->factory->getLanguageKey($file, $locale, $field);

                        foreach (Arr::dot(Arr::wrap($children)) as $key => $value) {
                            $groupedKey = Str::of($group)
                                ->when(is_string($key), fn (Stringable $str) => $str->append(".$key"))
                                ->toString();

                            $namespacedKey = Str::of($namespace)
                                ->whenNotEmpty(fn (Stringable $str) => $str->append('::'))
                                ->append($groupedKey)
                                ->toString();

                            if ($used->doesntContain($namespacedKey)) {
                                $this->results->push(new ResultObject(
                                    file: $file,
                                    key: $groupedKey,
                                    locale: $locale,
                                    namespaceHint: $namespace ?: null,
                                    namespaceHintedKey: $namespacedKey,
                                    value: $value
                                ));
                            }
                        }
                    }
                }
            }
        }

        return $this->results;
    }
}
