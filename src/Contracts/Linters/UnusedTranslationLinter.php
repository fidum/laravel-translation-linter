<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Linters;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;

interface UnusedTranslationLinter
{
    public function execute(): ResultObjectCollection;
}
