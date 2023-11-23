<?php

namespace Fidum\LaravelTranslationLinter\Linters;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;
use Fidum\LaravelTranslationLinter\Contracts\Linters\MissingTranslationLinter as MissingTranslationLinterContract;
use Fidum\LaravelTranslationLinter\Contracts\Readers\ApplicationFileReader;
use Fidum\LaravelTranslationLinter\Data\ApplicationFileObject;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Illuminate\Translation\Translator;

readonly class MissingTranslationLinter implements MissingTranslationLinterContract
{
    public function __construct(
        protected ApplicationFileReader $used,
        protected ResultObjectCollection $results,
        protected Translator $translator,
        protected array $locales,
    ) {}

    public function execute(): ResultObjectCollection
    {
        $this->results->reset();
        $used = $this->used->execute();

        foreach ($this->locales as $locale) {
            /** @var ApplicationFileObject $object */
            foreach ($used as $object) {
                if ($this->translator->hasForLocale($object->namespaceHintedKey, $locale)) {
                    continue;
                }

                $this->results->push(new ResultObject(
                    file: $object->file,
                    key: $object->key,
                    locale: $locale,
                    namespaceHint: $object->namespaceHint,
                    namespaceHintedKey: $object->namespaceHintedKey,
                ));
            }
        }

        return $this->results;
    }
}
