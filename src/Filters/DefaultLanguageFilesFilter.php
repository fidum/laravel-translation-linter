<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Illuminate\Support\Str;

class DefaultLanguageFilesFilter implements Filter
{
    public function shouldReport(string $lang, string $namespace, string $key, ?string $value): bool
    {
        if ($namespace) {
            return true;
        }

        return ! Str::startsWith($key, [
            'validation.',
            'passwords.',
            'pagination.',
            'auth.',
        ]);
    }
}
