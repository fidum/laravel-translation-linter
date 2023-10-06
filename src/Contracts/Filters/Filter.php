<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Filters;

interface Filter
{
    public function shouldReport(string $locale, string $namespace, string $key, ?string $value): bool;
}
