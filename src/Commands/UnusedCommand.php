<?php

namespace Fidum\LaravelTranslationLinter\Commands;

use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFieldCollection;
use Fidum\LaravelTranslationLinter\Contracts\Collections\UnusedFilterCollection;
use Fidum\LaravelTranslationLinter\Contracts\Linters\UnusedTranslationLinter;
use Illuminate\Console\Command;

class UnusedCommand extends Command
{
    public $signature = 'translation:unused';

    public $description = 'Finds unused language keys.';

    public function handle(
        UnusedFieldCollection $fields,
        UnusedFilterCollection $filters,
        UnusedTranslationLinter $linter,
    ): int {
        $results = $linter->execute()->whereShouldReport($filters);

        if ($results->isEmpty()) {
            $this->components->info('No unused translations found!');

            return self::SUCCESS;
        }

        $this->components->error(sprintf('%d unused translations found', $results->count()));
        $this->table($fields->headers(), $results->toCommandTableOutputArray($fields));

        return self::FAILURE;
    }
}
