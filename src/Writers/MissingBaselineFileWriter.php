<?php

namespace Fidum\LaravelTranslationLinter\Writers;

use Fidum\LaravelTranslationLinter\Contracts\Writers\MissingBaselineFileWriter as MissingBaselineFileWriterContract;
use Fidum\LaravelTranslationLinter\Writers\Concerns\WritesBaselineFile;
use Illuminate\Filesystem\Filesystem;

class MissingBaselineFileWriter implements MissingBaselineFileWriterContract
{
    use WritesBaselineFile;

    public function __construct(
        protected Filesystem $filesystem,
        protected string $file,
    ) {}
}
