<?php

namespace Fidum\LaravelTranslationLinter\Collections;

use Fidum\LaravelTranslationLinter\Collections\Concerns\CollectsFields;
use Fidum\LaravelTranslationLinter\Contracts\Collections\MissingFieldCollection as MissingFieldCollectionContract;
use Illuminate\Support\Collection;

class MissingFieldCollection extends Collection implements MissingFieldCollectionContract
{
    use CollectsFields;
}
