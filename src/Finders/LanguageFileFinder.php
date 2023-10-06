<?php

namespace Fidum\LaravelTranslationLinter\Finders;

use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Fidum\LaravelTranslationLinter\Managers\LanguageFileReaderManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

readonly class LanguageFileFinder implements LanguageFileFinderContract
{
    public function __construct(
        protected Filesystem $filesystem,
        protected LanguageFileReaderManager $manager,
    ) {}

    public function execute(string $path, string $locale): Collection
    {
        if ($this->filesystem->exists($path)) {
            $files = new Collection($this->filesystem->allFiles($path));
            $extensions = $this->manager->getEnabledDrivers();

            return $files->filter(function (SplFileInfo $file) use ($extensions, $locale) {
                if (in_array($file->getExtension(), $extensions)) {
                    if ($file->getFilenameWithoutExtension() === $locale) {
                        return true;
                    }

                    return str_contains(
                        $file->getPathname(),
                        DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR
                    );
                }

                return false;
            });
        }

        return new Collection();
    }
}
