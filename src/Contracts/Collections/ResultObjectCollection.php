<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Collections;

use Fidum\LaravelTranslationLinter\Contracts\Collections\FieldCollection as FieldCollectionContract;
use Fidum\LaravelTranslationLinter\Contracts\Collections\FilterCollection as FilterCollectionContract;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;

/**
 * @method self __construct(ResultObject[] $items = null)
 * @method self push(ResultObject $item)
 */
interface ResultObjectCollection extends Arrayable, Enumerable
{
    public function reset(): void;

    public function toBaselineJson(): string;

    public function toCommandTableOutputArray(FieldCollectionContract $fields): array;

    public function whereShouldReport(FilterCollectionContract $filters): self;
}
