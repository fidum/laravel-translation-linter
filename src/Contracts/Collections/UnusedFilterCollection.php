<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Collections;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Enumerable;

interface UnusedFilterCollection extends Arrayable, Enumerable
{
    public function shouldReport(string $locale, string $namespace, string $key, ?string $value): bool;
}
