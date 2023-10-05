<?php

namespace Fidum\LaravelTranslationLinter\Commands;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedResultCollection;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter;
use Illuminate\Console\Command;

class UnusedCommand extends Command
{
    public $signature = 'translation:unused';

    public $description = 'Finds unused language keys.';

    public function handle(
        UnusedFieldCollection $fields,
        UnusedFilterCollection $filters,
        UnusedResultCollection $results,
        UnusedTranslationLinter $linter,
    ): int {
        foreach ($linter->execute() as $lang => $namespaces) {
            foreach ($namespaces as $namespace => $translations) {
                foreach ($translations as $key => $value) {
                    if ($filters->shouldReport($lang, $namespace, $key, $value)) {
                        $results->addUnusedLanguageKey($lang, $namespace, $key, $value);
                    }
                }
            }
        }

        if ($results->isEmpty()) {
            $this->comment('No unused translations found!');

            return self::SUCCESS;
        }

        $this->error(sprintf('%d unused translations found', $results->count()));
        $this->table($fields->headers(), $results->toCommandTableOutputArray($fields));

        return self::FAILURE;
    }
}
