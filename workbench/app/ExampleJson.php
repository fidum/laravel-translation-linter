<?php

namespace Workbench\App;

use Illuminate\Validation\Validator;

class ExampleJson
{
    public function handle(Validator $validator)
    {
        __('Used PHP Class');
        __("Used Vendor PHP Class");

        __('Missing PHP Class');
        __('Only Missing English PHP Class');
    }
}
