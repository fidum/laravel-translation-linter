<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Parsers;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

interface ApplicationFileParser
{
    public function execute(SplFileInfo $file): Collection;
}
