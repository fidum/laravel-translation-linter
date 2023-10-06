<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Illuminate\Support\Str;

class IgnoreDefaultLanguageFilesFilter implements Filter
{
    public function shouldReport(ResultObject $object): bool
    {
        if ($object->namespaceHint) {
            return true;
        }

        return ! Str::startsWith($object->key, [
            'validation.',
            'passwords.',
            'pagination.',
            'auth.',
        ]);
    }
}
