<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Fidum\LaravelTranslationLinter\Data\ResultObject;

class IgnoreNamespacedKeysFilter implements Filter
{
    public function shouldReport(ResultObject $object): bool
    {
        return ! $object->namespaceHint;
    }
}
