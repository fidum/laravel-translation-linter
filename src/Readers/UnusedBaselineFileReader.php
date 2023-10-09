<?php

namespace Fidum\LaravelTranslationLinter\Readers;

use Fidum\LaravelTranslationLinter\Collections\BaselineCollection;
use Fidum\LaravelTranslationLinter\Contracts\Readers\UnusedBaselineFileReader as UnusedBaselineFileReaderContract;
use Illuminate\Filesystem\Filesystem;

class UnusedBaselineFileReader implements UnusedBaselineFileReaderContract
{
    protected array $decoded = [];

    public function __construct(
        protected Filesystem $filesystem,
        protected string $file,
    ) {}

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
