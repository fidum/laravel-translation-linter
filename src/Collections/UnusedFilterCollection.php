<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Collections\Concerns\CollectsFilters;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection as UnusedFilterCollectionContract;
use Illuminate\Support\Collection;

class UnusedFilterCollection extends Collection implements UnusedFilterCollectionContract
{
    use CollectsFilters;
}
