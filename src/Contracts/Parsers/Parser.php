<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Parsers;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

interface Parser
{
    public function execute(SplFileInfo $file): Collection;
}
