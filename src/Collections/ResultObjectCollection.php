<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\FieldCollection as FieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\FilterCollection as FilterCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection as ResultObjectCollectionContract;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ResultObjectCollection extends Collection implements ResultObjectCollectionContract
{
    public function reset(): void
    {
        $this->items = [];
    }

    public function toBaselineJson(): string
    {
        return $this
            ->groupBy('locale')
            ->map(fn (ResultObjectCollection $collection) => $collection->pluck('namespaceHintedKey')->values())
            ->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function toCommandTableOutputArray(FieldCollectionContract $fields): array
    {
        $only = $fields->enabled()->toArray();

        return $this->map(fn (ResultObject $object) => Arr::only($object->toArray(), $only))->toArray();
    }

    public function whereShouldReport(FilterCollectionContract $filters): ResultObjectCollectionContract
    {
        return $this->filter($filters->shouldReport(...));
    }
}
