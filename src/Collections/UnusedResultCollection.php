<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedResultCollection as UnusedResultCollectionContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class UnusedResultCollection extends Collection implements UnusedResultCollectionContract
{
    public function addUnusedLanguageKey(string $locale, string $namespace, string $key, ?string $value): self
    {
        return $this->push([
            'locale' => $locale,
            'namespace' => $namespace,
            'key' => $key,
            'value' => $value,
        ]);
    }

    public function toCommandTableOutputArray(UnusedFieldCollectionContract $fields): array
    {
        $only = $fields->enabled()->toArray();

        return $this->map(fn (array $data) => Arr::only($data, $only))->toArray();
    }
}
