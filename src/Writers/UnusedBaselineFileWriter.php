<?php

namespace Fidum\LaravelTranslationLinter\Writers;

use Fidum\LaravelTranslationLinter\Contracts\Writers\UnusedBaselineFileWriter as UnusedBaselineFileWriterContract;
use Fidum\LaravelTranslationLinter\Writers\Concerns\WritesBaselineFile;
use Illuminate\Filesystem\Filesystem;

class UnusedBaselineFileWriter implements UnusedBaselineFileWriterContract
{
    use WritesBaselineFile;

    public function __construct(
        protected Filesystem $filesystem,
        protected string $file,
    ) {}
}
