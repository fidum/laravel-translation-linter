<?php

namespace Fidum\LaravelTranslationLinter\Finders;

use Fidum\LaravelTranslationLinter\Contracts\Finders\ApplicationFileFinder as ApplicationFileFinderContract;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class ApplicationFileFinder implements ApplicationFileFinderContract
{
    public function __construct(
        protected Filesystem $filesystem,
        protected array $directories,
        protected array $extensions
    ) {
    }

    public function execute(): Collection
    {
        $files = new Collection();

        foreach ($this->directories as $directory) {
            $files = $files->merge($this->filesystem->allFiles($directory));
        }

        return $files->filter(function (\SplFileInfo $file) {
            return in_array($file->getExtension(), $this->extensions);
        });
    }
}
