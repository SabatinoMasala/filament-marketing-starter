<template>
    <Head>
        <title>{{ title }}</title>

        <meta name="description" :content="seo.description" v-if="seo.description" />
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="seo.description" v-if="seo.description" />
        <meta property="og:image" :content="asset(seo.image)" v-if="seo.image" />

        <meta name="twitter:image" :content="asset(seo.image)" v-if="seo.image" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="seo.description" v-if="seo.description" />

    </Head>
</template>
<script setup>
import {Head} from '@inertiajs/vue3'
const props = defineProps({
    title: String,
    seo: [Object, String]
})
const title = props.seo && props.seo.title ? props.seo.title : props.title;
</script>
