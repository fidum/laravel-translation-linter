<?php

namespace Fidum\LaravelTranslationLinter\Finders;

use Fidum\LaravelTranslationLinter\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Collection;

readonly class LanguageNamespaceFinder implements LanguageNamespaceFinderContract
{
    public function __construct(protected Translator $translator)
    {
    }

    public function execute(): Collection
    {
        $namespacesCollection = new Collection();

        // Get Translator namespaces
        $loader = $this->translator->getLoader();

        foreach ($loader->namespaces() as $hint => $path) {
            $namespacesCollection->put($hint, $path);
        }

        // Add default namespace
        $namespacesCollection->put('', app()->langPath());

        // Return namespaces collection after removing non existing paths
        return $namespacesCollection->filter(function ($path) {
            return file_exists($path) ? $path : false;
        });
    }
}
