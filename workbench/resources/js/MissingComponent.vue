<template>
    {{ __('example.vue.missing', {foo: 'bar'}) }}
    {{ __(
        'folder/example.vue.missing',
        {foo: 'bar'}
    )}}
</template>

<script setup>
const exampleA = computed(() => __('example::example.vue.missing'))
const exampleB = computed(() => __(
    'example::folder/example.vue.missing'
))
const exampleC = computed(() => __(
    'Missing Vue Component',
    {foo: 'bar'},
))
const exampleD = computed(() => __(
    'Missing Vendor Vue Component',
    {foo: 'bar'},
))
</script>
