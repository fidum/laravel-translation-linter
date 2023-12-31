<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Readers\UnusedBaselineFileReader as UnusedBaselineFileReaderContract;
use Fidum\LaravelTranslationLinter\Readers\Concerns\ReadsBaselineFile;
use Illuminate\Filesystem\Filesystem;

class UnusedBaselineFileReader implements UnusedBaselineFileReaderContract
{
    use ReadsBaselineFile;

    public function __construct(
        protected Filesystem $filesystem,
        protected string $file,
    ) {}
}
