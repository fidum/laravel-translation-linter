<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Readers;

use Fidum\LaravelTranslationLinter\Collections\BaselineCollection;

interface BaselineFileReader
{
    public function execute(): BaselineCollection;
}
