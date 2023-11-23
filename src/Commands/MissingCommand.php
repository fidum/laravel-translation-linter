<?php

namespace Fidum\LaravelTranslationLinter\Commands;

use Fidum\LaravelTranslationLinter\Collections\ResultObjectCollection;
use Fidum\LaravelTranslationLinter\Contracts\Collections\MissingFieldCollection;
use Fidum\LaravelTranslationLinter\Contracts\Collections\MissingFilterCollection;
use Fidum\LaravelTranslationLinter\Contracts\Linters\MissingTranslationLinter;
use Fidum\LaravelTranslationLinter\Data\ResultObject;
use Fidum\LaravelTranslationLinter\Filters\IgnoreKeysFromMissingBaselineFileFilter;
use Fidum\LaravelTranslationLinter\Writers\MissingBaselineFileWriter;
use Illuminate\Console\Command;

class MissingCommand extends Command
{
    public $signature = 'translation:missing
        {paths?* : One or more absolute paths to files you specifically want to scan for missing keys.}
        {--b|generate-baseline : Generate a baseline file from the missing keys.}';

    public $description = 'Finds unused language keys.';

    public function handle(
        MissingBaselineFileWriter $writer,
        MissingFieldCollection $fields,
        MissingFilterCollection $filters,
        MissingTranslationLinter $linter,
    ): int {
        $baseline = (bool) $this->option('generate-baseline');
        $results = $linter->execute();

        if ($baseline) {
            $results = $results->whereShouldReport($filters)->uniqueForLocale();

            $writer->execute($results);

            $this->components->info("Baseline file written with {$results->count()} translation keys.");

            return self::SUCCESS;
        }

        $filters->push(IgnoreKeysFromMissingBaselineFileFilter::class);

        $results = $results
            ->when($this->argument('paths'), function (ResultObjectCollection $items, array $files) {
                return $items->filter(fn (ResultObject $object) => in_array($object->file->getPathname(), $files));
            })
            ->whereShouldReport($filters);

        if ($results->isEmpty()) {
            $this->components->info('No missing translations found!');

            return self::SUCCESS;
        }

        $this->components->error(sprintf('%d missing translations found', $results->count()));
        $this->table($fields->headers(), $results->toCommandTableOutputArray($fields));

        return self::FAILURE;
    }
}
