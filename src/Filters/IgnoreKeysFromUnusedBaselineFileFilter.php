<?php

namespace Fidum\LaravelTranslationLinter\Filters;

use Fidum\LaravelTranslationLinter\Contracts\Filters\Filter;
use Fidum\LaravelTranslationLinter\Contracts\Readers\UnusedBaselineFileReader;
use Fidum\LaravelTranslationLinter\Data\ResultObject;

class IgnoreKeysFromUnusedBaselineFileFilter implements Filter
{
    public function __construct(protected UnusedBaselineFileReader $reader) {}

    public function shouldReport(ResultObject $object): bool
    {
        return $this->reader
            ->execute()
            ->shouldReport($object->locale, $object->namespaceHintedKey);
    }
}
