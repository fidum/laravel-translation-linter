<?php

namespace Workbench\App;

use Illuminate\Support\Facades\Lang;

class Example
{
    public function handle()
    {
        $example = __('example.used');

        if (true) {
            trans('folder/example.used');
            trans_choice('example::example.used');
        }

        collect()->when(fn () => Lang::get(
            'example::folder/example.used'
        ));
    }
}
