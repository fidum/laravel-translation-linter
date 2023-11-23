<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Collections\Concerns\CollectsFilters;
use Fidum\LaravelTranslationLinter\Contracts\Collections\MissingFilterCollection as MissingFilterCollectionContract;
use Illuminate\Support\Collection;

class MissingFilterCollection extends Collection implements MissingFilterCollectionContract
{
    use CollectsFilters;
}
