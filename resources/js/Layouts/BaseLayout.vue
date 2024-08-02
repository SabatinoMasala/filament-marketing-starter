<template>
    <div class="wrap">
        <Navbar />
        <slot />
        <Footer></Footer>
    </div>
</template>
<style scoped>
.wrap {
    border-left: 1px solid rgba(0, 0, 0, .15);
    border-right: 1px solid rgba(0, 0, 0, .15);
    margin: 0 auto;
    max-width: 1500px;
}
</style>
<script setup>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

</script>
