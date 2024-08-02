<template>
    <enhanced-link :href="href" :class="`inline-block rounded-md bg-${variant}-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-${variant}-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-${variant}-600`">
        {{ title }}
    </enhanced-link>
</template>
<script>
import EnhancedLink from "@/Components/EnhancedLink.vue";

export default {
    components: {EnhancedLink},
    props: {
        title: String,
        variant: String,
        href: String,
    },
}
</script>
