<script setup>
import { computed } from 'vue'
import BaseLayout from "@/Layouts/BaseLayout.vue";
import EnhancedLink from "@/Components/EnhancedLink.vue";

const props = defineProps({ status: Number })

const title = computed(() => {
    return {
        503: 'Service Unavailable',
        500: 'Server Error',
        404: 'Page Not Found',
        403: 'Forbidden',
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
})
</script>

<template>
    <BaseLayout>
        <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
            <div class="text-center">
                <p class="text-base font-semibold text-red-600">{{ props.status }}</p>
                <h1 class="font-secondary mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ title }}</h1>
                <p class="mt-6 text-base leading-7 text-gray-600">{{ description }}</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <enhanced-link href="/" class="rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Go back home</enhanced-link>
                    <enhanced-link href="/nl/contact" class="text-sm font-semibold text-gray-900">Contact support <span aria-hidden="true">&rarr;</span></enhanced-link>
                </div>
            </div>
        </main>
    </BaseLayout>
</template>
