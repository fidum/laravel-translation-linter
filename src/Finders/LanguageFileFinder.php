<?php

namespace Fidum\LaravelTranslationLinter\Finders;

use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

readonly class LanguageFileFinder implements LanguageFileFinderContract
{
    public function __construct(protected Filesystem $filesystem) {}

    public function execute(string $path, array $extensions): Collection
    {
        $files = new Collection($this->filesystem->allFiles($path));

        return $files->filter(fn (\SplFileInfo $file) => in_array($file->getExtension(), $extensions));
    }
}
