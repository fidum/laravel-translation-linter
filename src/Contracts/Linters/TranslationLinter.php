<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Linters;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;

interface TranslationLinter
{
    public function execute(): ResultObjectCollection;
}
