<template>
    <div>
        <pre>{{ data }}</pre>
    </div>
</template>
<script setup>
const props = defineProps({
    data: Object
})
</script>
