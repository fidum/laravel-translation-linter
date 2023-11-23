<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Collections\Concerns\CollectsFields;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection as UnusedFieldCollectionContract;
use Illuminate\Support\Collection;

class UnusedFieldCollection extends Collection implements UnusedFieldCollectionContract
{
    use CollectsFields;
}
