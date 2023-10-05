<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;

class IgnoreNamespacedKeysFilter implements Filter
{
    public function shouldReport(string $lang, string $namespace, string $key, ?string $value): bool
    {
        return ! $namespace;
    }
}
