<template>
    <div class="py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl" v-if="props.data.title">
                    {{ props.data.title }}
                </h2>
                <div class="mt-4 text-lg leading-8 text-red-300" v-html="props.data.subtitle"></div>
            </div>
            <div class="bg-red-600 mx-auto max-w-2xl lg:max-w-none rounded-lg">
                <dl :class="`grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-${props.data.statistics.length}`">
                    <div v-for="stat in props.data.statistics" :key="stat.id" class="flex flex-col bg-white/5 p-8">
                        <dt class="text-sm font-semibold leading-6 text-red-300">{{ stat.label }}</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">{{ stat.quantity }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    data: Object,
})
const stats = [
    { id: 1, name: 'Creators on the platform', value: '8,000+' },
    { id: 2, name: 'Flat platform fee', value: '3%' },
    { id: 3, name: 'Uptime guarantee', value: '99.9%' },
    { id: 4, name: 'Paid out to creators', value: '$70M' },
]
</script>
