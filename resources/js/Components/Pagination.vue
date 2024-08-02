<template>
    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        <enhanced-link :href="getRoute(currentPage - 1)" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Previous</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
        </enhanced-link>
        <enhanced-link :href="getRoute(i)" :class="getClasses(i)" v-for="i in totalPages">
            {{ i }}
        </enhanced-link>
        <enhanced-link :href="getRoute(currentPage + 1)" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Next</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
        </enhanced-link>
    </nav>
</template>
<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'
import EnhancedLink from "@/Components/EnhancedLink.vue";
const props = defineProps({
    currentPage: Number,
    totalPages: Number,
    path: String,
})

const getClasses = (page) => {
    if (page === props.currentPage) {
        return 'relative z-10 inline-flex items-center bg-red-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600'
    }
    return 'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0';
}
const getRoute = (page) => {
    if (page > props.totalPages) {
        return `${props.path}?page=${props.totalPages}`
    }
    if (page === 0) {
        page = 1;
    }
    return `${props.path}?page=${page}`
}
</script>
