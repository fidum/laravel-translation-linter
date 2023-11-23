<?php

namespace Workbench\App;

use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Validator;

class ExampleMissingOther
{
    public function missing()
    {
        if (true) {
            trans("folder/example.missing");
            trans_choice('example::example.missing');
        }
    }
}
