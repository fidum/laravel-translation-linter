<?php

namespace Fidum\LaravelTranslationLinter\Readers\Concerns;

use Fidum\LaravelTranslationLinter\Collections\BaselineCollection;

trait ReadsBaselineFile
{
    protected array $decoded = [];

    public function execute(): BaselineCollection
    {
        if ($this->decoded) {
            return BaselineCollection::wrap($this->decoded);
        }

        if ($this->filesystem->exists($this->file)) {
            $contents = $this->filesystem->get($this->file);

            $this->decoded = json_decode($contents, true);
        }

        return BaselineCollection::wrap($this->decoded);
    }
}
