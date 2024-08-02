<template>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <article v-for="post in props.data.items" :key="post.id" class="flex flex-col items-start justify-between">
                    <div class="relative w-full">
                        <img :src="asset(post.featured_image, 'BLOG_CARD')" :alt="post.title" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]" v-if="post.featured_image" />
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10" />
                    </div>
                    <div class="max-w-xl">
                        <div class="mt-8 flex items-center gap-x-4 text-xs">
                            <time :datetime="post.datetime" class="text-gray-500">{{ post.datetime_readable }}</time>
                            <a v-if="false" :href="post.category.href" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ post.category.title }}</a>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <enhanced-link :href="`${data.meta.base_path}/${post.slug}`">
                                    <span class="absolute inset-0" />
                                    {{ post.title }}
                                </enhanced-link>
                            </h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">{{ post.short_description }}</p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4" v-if="false">
                            <img :src="asset(post.author.imageUrl)" alt="" class="h-10 w-10 rounded-full bg-gray-100" />
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    <enhanced-link :href="post.author.href">
                                        <span class="absolute inset-0" />
                                        {{ post.author.name }}
                                    </enhanced-link>
                                </p>
                                <p class="text-gray-600">{{ post.author.role }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="flex justify-center items-center py-10">
            <Pagination :per-page="data.meta.per_page" :current-page="data.meta.current_page" :total-pages="data.meta.last_page" path="/nl/blog" />
        </div>
    </div>
</template>
<script setup>
import Pagination from "@/Components/Pagination.vue";
import EnhancedLink from "@/Components/EnhancedLink.vue";

const props = defineProps({
    data: Object,
})

</script>
