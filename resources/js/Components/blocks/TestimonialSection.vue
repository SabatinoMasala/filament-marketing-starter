<template>
    <div class="relative isolate bg-white text-center pb-32 pt-24 sm:pt-32" v-if="!isValid">
        At least 3 testimonials are needed
    </div>
    <div class="relative isolate bg-white pb-32 pt-24 sm:pt-32" v-else>
        <div class="absolute inset-x-0 top-1/2 -z-10 -translate-y-1/2 transform-gpu overflow-hidden opacity-30 blur-3xl" aria-hidden="true">
            <div class="ml-[max(50%,38rem)] aspect-[1313/771] w-[82.0625rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
        </div>
        <div class="absolute inset-x-0 top-0 -z-10 flex transform-gpu overflow-hidden pt-32 opacity-25 blur-3xl sm:pt-40 xl:justify-end" aria-hidden="true">
            <div class="ml-[-22rem] aspect-[1313/771] w-[82.0625rem] flex-none origin-top-right rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#800F4D] xl:ml-0 xl:mr-[calc(50%-12rem)]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
        </div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center">
                <h2 class="text-lg font-semibold leading-8 tracking-tight text-accent">
                    {{ data.review_section_subheader }}
                </h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {{ data.review_section_header }}
                </p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 grid-rows-1 gap-8 text-sm leading-6 text-gray-900 sm:mt-20 sm:grid-cols-2 xl:mx-0 xl:max-w-none xl:grid-flow-col xl:grid-cols-4">
                <figure class="rounded-2xl bg-white shadow-lg ring-1 ring-gray-900/5 sm:col-span-2 xl:col-start-2 xl:row-end-1">
                    <blockquote class="p-6 text-lg font-semibold leading-7 tracking-tight text-gray-900 sm:p-12 sm:text-xl sm:leading-8" v-html="featuredTestimonial.body">
                    </blockquote>
                    <figcaption class="flex flex-wrap items-center gap-x-4 gap-y-4 border-t border-gray-900/10 px-6 py-4 sm:flex-nowrap">
                        <img class="h-10 w-10 flex-none rounded-full bg-gray-50" :src="asset(featuredTestimonial.author.imageUrl, 'PERSON_SMALL')" alt="" v-if="featuredTestimonial.author.imageUrl" />
                        <div class="flex-auto">
                            <div class="font-semibold">{{ featuredTestimonial.author.name }}</div>
                        </div>
                    </figcaption>
                </figure>
                <div v-for="(columnGroup, columnGroupIdx) in testimonials" :key="columnGroupIdx" class="space-y-8 xl:contents xl:space-y-0">
                    <div v-for="(column, columnIdx) in columnGroup" :key="columnIdx" :class="[(columnGroupIdx === 0 && columnIdx === 0) || (columnGroupIdx === testimonials.length - 1 && columnIdx === columnGroup.length - 1) ? 'xl:row-span-2' : 'xl:row-start-1', 'space-y-8']">
                        <figure v-for="testimonial in column" class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-900/5">
                            <blockquote class="text-gray-900" v-html="testimonial.body">
                            </blockquote>
                            <figcaption class="mt-6 flex items-center gap-x-4" v-if="testimonial.author">
                                <img class="h-10 w-10 rounded-full bg-gray-50" :src="asset(testimonial.author.imageUrl, 'PERSON_SMALL')" alt="" v-if="testimonial.author.imageUrl" />
                                <div>
                                    <div class="font-semibold">{{ testimonial.author.name }}</div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {ref} from "vue";

const props = defineProps({
    data: Object
})

const allTestimonials = props.data.testimonials.map(testimonial => {
    return {
        body: testimonial.review,
        author: {
            name: testimonial.name,
            imageUrl: testimonial.picture,
        },
    }
});

const isValid = ref(true);
if (allTestimonials.length < 3) {
    console.error('Testimonial section must have at least 3 testimonials');
    isValid.value = false;
}

const featuredTestimonial = allTestimonials[0];

const testimonials = [
    [
        [allTestimonials[1]]
    ],
    [
        []
    ],
    [
        []
    ],
    [
        [allTestimonials[2]]
    ],
];

const otherTestimonials = allTestimonials.slice(3);

const numCols = 4;
for (let i = 0; i < numCols; i++) {
    for (let j = 0; j < otherTestimonials.length; j++) {
        if (j % numCols === i) {
            testimonials[i][0].push(otherTestimonials[j]);
        }
    }
}

</script>
