@lang('example.blade.lang.missing', ['foo' => 'bar'])
@lang(
    'folder/example.blade.lang.missing',
    ['foo' => 'bar'],
)
@lang('example::example.blade.lang.missing')
@lang(
    "example::folder/example.blade.lang.missing"
)

{{ __('Missing Blade File') }}

@if(true)
    @choice('example.blade.choice.missing', 1)
    @choice('folder/example.blade.choice.missing', 1)
    @choice('example::example.blade.choice.missing', 1)
    @choice(
        "example::folder/example.blade.choice.missing",
        1,
    )
@endif
