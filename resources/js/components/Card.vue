<script setup>

import {ref} from "vue";

const {product} = defineProps({
    product: Object,
});

const {name, description, price, image, image_alt} = product;

let quantity = ref(1);

function addItem() {
    console.log('Add to cart');
    console.log(product.product_uuid);
    console.log(quantity.value);
}

</script>

<template>
    <div
        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg flex max-w-xs cursor-pointer">
        <div>
            <div class="w-full mx-auto flex justify-center align-middle">
                <img :src="image" :alt="image_alt" class="h-32 w-32"/>
            </div>

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ name }}</h2>

            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{ description }}</p>
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed font-bold">{{ price }}</p>

            <div class="flex">
                <div>
                    <button class="mt-4 bg-primary text-white px-4 py-2 rounded-lg" @click="quantity++">
                        +
                    </button>
                    <input type="number" class="mt-4 w-12 h-8 rounded-lg text-center" v-model="quantity">
                    <button class="mt-4 bg-primary text-white px-4 py-2 rounded-lg"
                            @click="quantity > 1 ? quantity-- : null"> -
                    </button>
                </div>

                <div>
                    <button class="mt-4 bg-primary text-white px-4 py-2 rounded-lg" @click="addItem()">Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
