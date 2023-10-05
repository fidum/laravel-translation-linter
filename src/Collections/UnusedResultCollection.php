<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedResultCollection as UnusedResultCollectionContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class UnusedResultCollection extends Collection implements UnusedResultCollectionContract
{
    public function addUnusedLanguageKey(string $lang, string $namespace, string $key, ?string $value): UnusedResultCollectionContract
    {
        return $this->push([
            'lang' => $lang,
            'namespace' => $namespace,
            'key' => $key,
            'value' => $value,
        ]);
    }

    public function toCommandTableOutputArray(UnusedFieldCollectionContract $fields): array
    {
        return Arr::only($this->items, $fields->enabled()->toArray());
    }
}
