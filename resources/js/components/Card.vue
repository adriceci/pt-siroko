<script setup>

import {ref} from "vue";
import {getCart, setCart} from "./Cart.vue";

const AVAILABLE = 'available';
const UNAVAILABLE = 'unavailable';

const {product} = defineProps({
    product: Object,
});

const {name, description, price, image, image_alt, stock, status} = product;

let quantity = ref(1);

function addItem() {
    getCart().then(cart => {
        let products = JSON.parse(cart.products) || [];

        let item = products.findIndex(item => item.product_uuid === product.product_uuid);

        if (item !== -1) {
            products[item].quantity = quantity.value;
        } else {
            products.push({
                ...product,
                quantity: quantity.value
            });
        }

        cart.products = JSON.stringify(products);

        setCart(cart).then(() => {
            console.log('Item added to cart');
        });
    });
}

</script>

<template>
    <div
        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg flex max-w-xs">
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
                    <button
                        class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg"
                        :class="stock === 0 || status === UNAVAILABLE ? 'hidden' : 'd-block'"
                        @click="addItem()"
                    >
                        Add to cart
                    </button>
                    <div
                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg"
                        :class="stock === 0 || status === UNAVAILABLE ? 'd-block cursor-default' : 'hidden'">
                        Out of stock
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
