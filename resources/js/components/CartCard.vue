<script setup>

import {ref} from "vue";
import {getCart, setCart} from "./Cart.vue";

const {product} = defineProps({
    product: Object,
});

const {name, description, price, image, image_alt} = product;

let quantity = ref(product.quantity || 1);

function updateQuantity(quantity) {
    if (quantity < 1 || quantity === '' || isNaN(quantity)) {
        return;
    }
    let cart = getCart();

    let products = JSON.parse(cart.products) || [];

    let item = products.findIndex(item => item.product_uuid === product.product_uuid);

    products[item].quantity = quantity;

    cart.products = JSON.stringify(products);

    setCart(cart);
}

function removeItem() {
    let cart = getCart();

    let products = JSON.parse(cart.products) || [];

    let item = products.findIndex(item => item.product_uuid === product.product_uuid);

    products.splice(item, 1);

    cart.products = JSON.stringify(products);

    setCart(cart);
    window.location.reload();
}

function confirmRemove() {
    if (confirm('Are you sure you want to remove this item?')) {
        removeItem();
    }
}

</script>

<template>
    <div
        class="my-4 p-6 outline outline-indigo-500 rounded-lg flex max-w-xs max-h-[12rem]">
        <div>
            <div class="w-full mx-auto flex items-center">
                <img :src="image" :alt="image_alt" class="h-12 w-12"/>
                <h3 class="mx-auto text-xl font-semibold text-gray-900 dark:text-white">{{ name }}</h3>

            </div>


            <div class="flex items-center justify-between gap-4">

                <p class="my-1 text-gray-500 dark:text-gray-400 text-sm leading-relaxed line-clamp-2">
                    {{
                        description
                    }}</p>
                <p class="my-1 text-gray-500 dark:text-gray-400 text-sm leading-relaxed font-bold">{{ price }}</p>
            </div>

            <div class="flex items-center justify-between gap-4">
                <div>
                    <button class="mt-4 bg-primary text-white px-4 py-2 rounded-lg" @click="updateQuantity(++quantity)">
                        +
                    </button>
                    <input type="number" class="mt-4 w-12 h-8 rounded-lg text-center" v-model="quantity"
                           @keyup="updateQuantity(quantity)">
                    <button class="mt-4 bg-primary text-white px-4 py-2 rounded-lg"
                            @click="quantity > 1 ? updateQuantity(--quantity) : null"> -
                    </button>
                </div>

                <div>
                    <button
                        class="mt-4 bg-primary text-white px-4 py-2 rounded-lg bg-red-400 hover:bg-red-500"
                        @click="confirmRemove"
                    >
                        Remove
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
