<template>
    <div class="overflow-hidden bg-white py-12 sm:py-18">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div :class="classes">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base font-semibold leading-7 text-primary">
                            {{ data.supertitle }}
                        </h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            {{ data.title }}
                        </p>
                        <div class="mt-6 text-lg leading-8 text-gray-600" v-html="data.description"></div>
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none" v-if="data.features.length > 0">
                            <div v-for="feature in data.features" :key="feature.id" class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <CheckIcon class="absolute left-1 top-1 h-5 w-5 text-primary" aria-hidden="true" />
                                    {{ feature.title }}
                                </dt>
                                {{ ' ' }}
                                <dd class="inline">
                                    {{ feature.description }}
                                    <a :href="feature.button_link" class="text-sm text-primary font-semibold leading-6" v-if="feature.button_link">{{ feature.button_text }} <span aria-hidden="true">→</span></a>
                                </dd>
                            </div>
                        </dl>
                        <div class="mt-5 text-center" v-if="data.cta_link">
                            <UButton :href="data.cta_link" variant="red" :title="data.cta_button_text" />
                        </div>
                    </div>
                </div>
                <img :src="asset(data.image, 'DETAIL_SECTION')" alt="Product screenshot" class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0" v-if="position === 'right'" />
                <div class="flex items-start justify-end lg:order-first" v-else>
                    <img :src="asset(data.image, 'DETAIL_SECTION')" alt="Product screenshot" class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0" />
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import {CheckIcon} from '@heroicons/vue/20/solid'
import {computed} from "vue";
import UButton from '@/Components/UButton.vue';

const props = defineProps({
    data: Object,
})

const position = props.data.image_position;

const classes = computed(() => {
    return {
        'lg:pr-8 lg:pt-4': position === 'right',
        'lg:ml-auto lg:pl-4 lg:pt-4': position === 'left',
    }
});
</script>
