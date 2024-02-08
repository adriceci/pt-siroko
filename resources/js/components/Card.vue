<script setup>

const { product } = defineProps({
    product: Object,
});

const { name, description, price, image, image_alt } = product;

function addItem() {
    console.log('Add to cart');
}

</script>

<template>
    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg flex max-w-xs cursor-pointer" @click="addItem()">
        <div>
            <div class="h-32 w-32 flex items-center justify-center">
                <img :src="image" :alt="image_alt" class="h-32 w-32" />
            </div>

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ name }}</h2>

            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ description }}</p>
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed font-bold">{{ price }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
