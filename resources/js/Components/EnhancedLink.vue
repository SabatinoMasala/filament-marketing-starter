<template>
    <component :is="component" :href="props.href" :class="props.class" :target="target">
        <slot></slot>
    </component>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
const props = defineProps({
    href: String,
    target: String,
    class: String,
})
const component = props.href && props.href.startsWith('http') ? 'a' : Link;
</script>
