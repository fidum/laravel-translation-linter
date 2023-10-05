<?php

namespace Workbench\App;

use Illuminate\Support\Facades\Lang;

class Example
{
    public function handle()
    {
        __('example.used');
        trans('folder/example.used');
        trans_choice('example::example.used');
        Lang::get(
            'example::folder/example.used'
        );
    }
}
