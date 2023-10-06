<template>
    {{ __('example.vue.used', {foo: 'bar'}) }}
    {{ __(
        'folder/example.vue.used',
        {foo: 'bar'}
    )}}
</template>

<script setup>
const exampleA = computed(() => __('example::example.vue.used'))
const exampleB = computed(() => __(
    'example::folder/example.vue.used'
))
</script>
