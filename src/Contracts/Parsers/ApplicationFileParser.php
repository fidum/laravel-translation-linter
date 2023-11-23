<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Parsers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;
use Symfony\Component\Finder\SplFileInfo;

interface ApplicationFileParser
{
    public function execute(SplFileInfo $file): ApplicationFileCollectionContract;
}
