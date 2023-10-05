<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Collections;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;

interface UnusedFieldCollection extends Arrayable, Enumerable
{
    public function enabled(): self;

    public function headers(): array;
}
