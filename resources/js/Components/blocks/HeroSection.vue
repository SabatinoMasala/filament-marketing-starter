<template>
    <div class="relative" :class="background">
        <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
            <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 xl:col-span-6">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h1 :class="`${color}`" class="mt-24 text-4xl font-extrabold font-secondary tracking-tight">
                        {{ props.data.hero_title }}
                    </h1>
                    <div :class="`${color}`" class="mt-6 text-lg leading-8" v-html="props.data.hero_content"></div>
                    <div class="mt-10 flex items-center gap-x-6 flex-col md:flex-row space-y-3 md:space-y-0">
                        <template v-for="button in props.data.buttons">
                            <UButton :variant="button.variant" :href="button.url" :title="button.label" v-if="button.variant && button.variant !== 'transparent'" />
                            <enhanced-link :class="`${color}`" :href="button.url" class="text-sm font-semibold leading-6" v-else>{{ button.label }} <span aria-hidden="true">→</span></enhanced-link>
                        </template>
                    </div>
                </div>
            </div>
            <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0" v-if="props.data.hero_image">
                <img class="aspect-[3/2] w-full object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full" :src="asset(props.data.hero_image)" alt="" />
            </div>
        </div>
    </div>
</template>
<script setup>
import UButton from "@/Components/UButton.vue";
import EnhancedLink from "@/Components/EnhancedLink.vue";

const props = defineProps({
    data: Object,
})
const background = props.data.background ? `bg-${props.data.background}` : 'bg-primary';
const color = background === 'bg-white' ? 'text-black' : 'text-white';
</script>
