<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Writers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;

interface BaselineFileWriter
{
    public function execute(ResultObjectCollection $results);
}
