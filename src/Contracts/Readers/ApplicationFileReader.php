<?php

namespace Fidum\LaravelTranslationLinter\Contracts\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ApplicationFileCollection as ApplicationFileCollectionContract;

interface ApplicationFileReader
{
    public function execute(): ApplicationFileCollectionContract;
}
