<?php

namespace Fidum\LaravelTranslationLinter\Commands;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter;
use Fidum\LaravelTranslationLinter\Filters\IgnoreKeysFromUnusedBaselineFileFilter;
use Fidum\LaravelTranslationLinter\Writers\UnusedBaselineFileWriter;
use Illuminate\Console\Command;

class UnusedCommand extends Command
{
    public $signature = 'translation:unused
        {--b|generate-baseline : Generate a baseline file from the unused keys.}';

    public $description = 'Finds unused language keys.';

    public function handle(
        UnusedBaselineFileWriter $writer,
        UnusedFieldCollection $fields,
        UnusedFilterCollection $filters,
        UnusedTranslationLinter $linter,
    ): int {
        $baseline = (bool) $this->option('generate-baseline');
        $results = $linter->execute();

        if ($baseline) {
            $results = $results->whereShouldReport($filters);

            $writer->execute($results);

            $this->components->info("Baseline file written with {$results->count()} unused translation keys.");

            return self::SUCCESS;
        }

        $filters->push(IgnoreKeysFromUnusedBaselineFileFilter::class);

        $results = $results->whereShouldReport($filters);

        if ($results->isEmpty()) {
            $this->components->info('No unused translations found!');

            return self::SUCCESS;
        }

        $this->components->error(sprintf('%d unused translations found', $results->count()));
        $this->table($fields->headers(), $results->toCommandTableOutputArray($fields));

        return self::FAILURE;
    }
}
