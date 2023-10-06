<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Collections;

use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;

interface FilterCollection extends Arrayable, Enumerable
{
    public function shouldReport(ResultObject $object): bool;
}
