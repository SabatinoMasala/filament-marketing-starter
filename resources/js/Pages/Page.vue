<template>
    <BaseLayout>
        <SEO :title="page.title" :seo="page.seo" />
        <Renderer :sections="page.content" />
    </BaseLayout>
</template>
<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import Renderer from "@/Components/Renderer.vue";
import SEO from "@/Components/SEO.vue";

const props = defineProps({
    page: Object,
})

</script>
