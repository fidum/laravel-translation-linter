<?php

namespace Fidum\LaravelTranslationLinter\Writers\Concerns;

use Fidum\LaravelTranslationLinter\Contracts\Collections\ResultObjectCollection;

trait WritesBaselineFile
{
    public function execute(ResultObjectCollection $results)
    {
        $path = $this->filesystem->dirname($this->file);

        $this->filesystem->ensureDirectoryExists($path);

        $this->filesystem->put($this->file, $results->toBaselineJson());
    }
}
