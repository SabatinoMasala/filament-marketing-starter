<template>
    <div class="title-with-subtitle" :class="data.variant === 'plain' ? 'bg-white' : ''">
        <template v-if="data.variant === 'plain'">
            <div class="mx-auto max-w-4xl text-center">
                <p class="text-base font-semibold leading-7 text-accent" v-if="data.subtitle">
                    {{ data.subtitle }}
                </p>
                <h1 class="font-secondary mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    {{ data.title }}
                </h1>
            </div>
            <div class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600" v-if="data.description" v-html="data.description"></div>
        </template>
        <template v-else>
            <div class="bg-part bg-secondary"></div>
            <div class="header">
                <h1 class="font-secondary text-center text-4xl font-bold sm:tracking-tight">{{ data.title }}</h1>
                <p class="subtitle text-xl mt-3 text-center mb-0" v-if="data.subtitle">{{ data.subtitle }}</p>
                <p class="subtitle text-xl mt-3 text-center mb-0" v-if="data.description" v-html="data.description"></p>
            </div>
        </template>
        <div class="mt-10 flex items-center justify-center gap-x-6">
            <enhanced-link :href="button.url" class="rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600" v-for="button in data.buttons">
                {{ button.label }}
            </enhanced-link>
        </div>
    </div>
</template>
<style scoped>
.bg-part {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    bottom: -50px;
    background-size: cover;
    z-index: -1;
}
.title-with-subtitle {
    position: relative;
    padding: 75px 0 50px 0;
    color: #fff;
}
</style>
<script setup>
import EnhancedLink from '@/Components/EnhancedLink.vue';

const props = defineProps({
    data: Object
})
</script>
