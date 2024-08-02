<script setup>
const props = defineProps({
    data: String
});
</script>
<template>
    <div class="wysiwyg-wrap" v-html="props.data.content"></div>
</template>
<style>
.wysiwyg-wrap figcaption {
    display: none;
}
.wysiwyg-wrap ul {
    margin-bottom: 25px;
}
.wysiwyg-wrap ul li p {
    margin: 0;
}
.wysiwyg-wrap ul li {
    list-style: disc;
    margin-left: 20px;
}
.wysiwyg-wrap h1, .wysiwyg-wrap h2, .wysiwyg-wrap h3, .wysiwyg-wrap h4, .wysiwyg-wrap h5, .wysiwyg-wrap h6 {
    line-height: 1.5;
}
.wysiwyg-wrap h1 {
    font-size: 36px;
    margin: 30px 0 15px 0;
    font-weight: bold;
}
.wysiwyg-wrap h2 {
    font-size: 36px;
    margin: 30px 0 15px 0;
    font-weight: bold;
}
.wysiwyg-wrap h3 {
    font-size: 28px;
    margin: 30px 0 15px 0;
    font-weight: bold;
}
.wysiwyg-wrap p {
    margin-bottom: 8px;
}

.wysiwyg-wrap a {
    text-decoration: underline;
}
</style>
