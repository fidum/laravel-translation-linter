<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Fidum\LaravelTranslationLinter\Data\ResultObject;

class IgnoreVendorKeysFilter implements Filter
{
    public function shouldReport(ResultObject $object): bool
    {
        return ! str_contains(
            haystack: $object->file->getPathname(),
            needle: DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR,
        );
    }
}
