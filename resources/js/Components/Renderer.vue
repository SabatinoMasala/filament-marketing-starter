<template>
    <div class="relative" v-for="section in sections">
        <component :is="getComponent(section.type)" :data="section.data" />
    </div>
</template>
<script setup>

// TODO, this will load all the blocks, investigate if we can lazy load them without FOUC
const blocks = import.meta.glob('./blocks/*.vue', { eager: true });

const makeComponent = (name) => {
    return blocks[`./blocks/${name}.vue`].default;
}

const props = defineProps({
    sections: Array,
})

const snakeToCamel = str => str.toLowerCase().replace(/(_\w)/g, m => m.toUpperCase().substr(1));
const capitalize = str => str.charAt(0).toUpperCase() + str.slice(1);

const getComponent = (type) => {
    const component = capitalize(snakeToCamel(type));
    try {
        return makeComponent(component);
    } catch (e) {
        console.error(`Component ${component} not found`);
        return makeComponent('NotFoundSection');
    }
}

</script>
