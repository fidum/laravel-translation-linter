<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Readers;

use Fidum\LaravelTranslationLinter\Collections\BaselineCollection;

interface UnusedBaselineFileReader
{
    public function execute(): BaselineCollection;
}
