<?php

namespace Workbench\App;

use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Validator;

class ExampleMissing
{
    public function missing()
    {
        collect()->when(fn () => Lang::get(
            'example::folder/example.missing'
        ));
    }
}
