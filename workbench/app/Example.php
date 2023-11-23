<?php

namespace Workbench\App;

use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Validator;

class Example
{
    public function unused()
    {
        $example = __('example.used');

        if (true) {
            trans("folder/example.used");
            trans_choice('example::example.used');
        }

        collect()->when(fn () => Lang::get(
            'example::folder/example.used'
        ));
    }

    public function missing()
    {
        $example = __('example.missing');
    }
}
