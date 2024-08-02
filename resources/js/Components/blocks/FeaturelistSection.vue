<template>
    <div class="bg-white py-12 sm:py-18">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-accent">
                        {{ data.subtitle }}
                    </h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        {{ data.title }}
                    </p>
                    <div class="mt-6 text-base leading-7 text-gray-600" v-html="data.content">
                    </div>
                </div>
                <dl class="col-span-2 grid grid-cols-1 gap-x-8 gap-y-10 text-base leading-7 text-gray-600 sm:grid-cols-2 lg:gap-y-16">
                    <div v-for="feature in data.features" :key="feature.title" class="relative pl-9">
                        <dt class="font-semibold text-gray-900">
                            <CheckIcon class="absolute left-0 top-1 h-5 w-5 text-accent" aria-hidden="true" />
                            {{ feature.title }}
                        </dt>
                        <dd class="mt-2" v-html="feature.description">
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    data: Object,
})
import { CheckIcon } from '@heroicons/vue/20/solid'
</script>
