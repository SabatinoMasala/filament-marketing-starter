<template>
    <BaseLayout>
        <SEO :title="post.title" :seo="post.seo" />
        <nav class="flex py-3 px-6" aria-label="Breadcrumb">
            <div class="mx-auto max-w-3xl container">
                <ol role="list" class="flex items-center space-x-4">
                    <li v-for="page in pages" :key="page.name">
                        <div class="flex items-center">
                            <enhanced-link :href="page.href" class="mr-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="page.current ? 'page' : undefined">{{ page.name }}</enhanced-link>
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" v-if="!page.isLast">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                        </div>
                    </li>
                </ol>
            </div>
        </nav>
        <div class="bg-white px-6 py-12 pb-2 lg:px-8">
            <div class="mx-auto max-w-3xl container text-base leading-7 text-gray-700">
                <p class="text-base font-semibold leading-7 text-red-600" v-if="false">TAGS TODO</p>
                <h1 class="font-secondary mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {{ post.title }}
                </h1>
                <p class="mt-6 text-xl leading-8 mb-5">
                    {{ post.short_description }}
                </p>
                <div class="bg-white">
                    <Renderer :sections="post.content" />
                </div>
            </div>
        </div>
    </BaseLayout>
</template>
<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import {defineProps} from "vue";
import {usePage} from "@inertiajs/vue3";
import Renderer from "@/Components/Renderer.vue";
import EnhancedLink from "@/Components/EnhancedLink.vue";
import SEO from "@/Components/SEO.vue";

const props = defineProps({
    post: Object,
})

const pages = [
    { name: 'Blog', href: `/${usePage().props.locale}/blog`, current: false },
    { name: props.post.title, href: `/${usePage().props.locale}/blog/${props.post.slug}`, current: true, isLast: true },
]
</script>
