<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Fidum\LaravelTranslationLinter\Contracts\Readers\MissingBaselineFileReader;
use Fidum\LaravelTranslationLinter\Data\ResultObject;

class IgnoreKeysFromMissingBaselineFileFilter implements Filter
{
    public function __construct(protected MissingBaselineFileReader $reader) {}

    public function shouldReport(ResultObject $object): bool
    {
        return $this->reader
            ->execute()
            ->shouldReport($object->locale, $object->namespaceHintedKey);
    }
}
