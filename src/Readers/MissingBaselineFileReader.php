<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Contracts\Readers\MissingBaselineFileReader as MissingBaselineFileReaderContract;
use Fidum\LaravelTranslationLinter\Readers\Concerns\ReadsBaselineFile;
use Illuminate\Filesystem\Filesystem;

class MissingBaselineFileReader implements MissingBaselineFileReaderContract
{
    use ReadsBaselineFile;

    public function __construct(
        protected Filesystem $filesystem,
        protected string $file,
    ) {}
}
