<template>
    <div class="py-24 sm:py-16" :class="bg">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-center text-lg font-semibold leading-8" :class="text">
                {{ data.title }}
            </h2>
            <div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                <img v-for="logo in data.logos" class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1" :src="asset(logo.url)" :alt="logo.title" />
            </div>
        </div>
    </div>
</template>
<style scoped>
img {
    filter: brightness(0) invert(1);
}
</style>
<script setup>
import {defineProps} from 'vue';
const props = defineProps({
    data: Object,
})
const bg = props.data.background && props.data.background === 'default' ? 'bg-primary' : 'bg-white';
const text = props.data.background && props.data.background === 'white' ? 'text-black' : 'text-white';
</script>
