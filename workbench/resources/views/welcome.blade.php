@lang('example.blade.lang.used')
@lang('folder/example.blade.lang.used')
@lang('example::example.blade.lang.used')
@lang('example::folder/example.blade.lang.used')

@if(true)
    @choice('example.blade.choice.used', 1)
    @choice('folder/example.blade.choice.used', 1)
    @choice('example::example.blade.choice.used', 1)
    @choice(
        'example::folder/example.blade.choice.used',
        1,
    )
@endif
