<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;

class IgnoreNamespacedKeysFilter implements Filter
{
    public function shouldReport(string $locale, string $namespace, string $key, ?string $value): bool
    {
        return ! $namespace;
    }
}
