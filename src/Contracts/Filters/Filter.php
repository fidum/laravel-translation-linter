<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Filters;

use Fidum\LaravelTranslationLinter\Data\ResultObject;

interface Filter
{
    public function shouldReport(ResultObject $object): bool;
}
