<?php

namespace Fidum\LaravelTranslationLinter\Writers;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;
use Fidum\LaravelTranslationLinter\Contracts\Writers\UnusedBaselineFileWriter as UnusedBaselineFileWriterContract;
use Illuminate\Filesystem\Filesystem;

class UnusedBaselineFileWriter implements UnusedBaselineFileWriterContract
{
    public function __construct(
        protected Filesystem $filesystem,
        protected string $file,
    ) {}

    public function execute(ResultObjectCollection $results)
    {
        $path = $this->filesystem->dirname($this->file);

        $this->filesystem->ensureDirectoryExists($path);

        $this->filesystem->put($this->file, $results->toBaselineJson());
    }
}
