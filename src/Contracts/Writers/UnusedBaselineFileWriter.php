<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Writers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;

interface UnusedBaselineFileWriter
{
    public function execute(ResultObjectCollection $results);
}
