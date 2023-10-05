<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;

interface UnusedResultCollection extends Arrayable, Enumerable
{
    public function addUnusedLanguageKey(string $lang, string $namespace, string $key, ?string $value): self;

    public function toCommandTableOutputArray(UnusedFieldCollectionContract $fields): array;
}
