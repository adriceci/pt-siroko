<script setup>

import CartCard from "./CartCard.vue";

let cart = getCart();

if (!cart) {
    window.location.href = '/login';
}

let products = JSON.parse(cart.products) || [];

let items = products.length;

</script>

<template>
    <div>
        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold text-white">Cart</h2>
            <div class="text-white bg-indigo-500 rounded-full w-6 h-6">
                <p class="ml-[.45rem]">{{ items }}</p>
            </div>
        </div>

        <div v-if="products.length === 0">
            <p class="text-white">Your cart is empty</p>
        </div>

        <div v-else>
            <div v-for="product in products" :key="product.id">
                <CartCard :product="product"/>
            </div>
        </div>
    </div>
</template>

<script>

import axios from "axios";
import {getToken, SIROKO_CART} from "../utils.js";

export async function createCart() {

    const token = getToken();

    const response = await axios.post('/cart', {}, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });

    setCart(response.data);
}

export function getCart() {
    try {
        // Get cart from local storage
        const cart = localStorage.getItem(SIROKO_CART);

        return JSON.parse(cart);

    } catch (e) {
        console.log(e);
    }
}

export function setCart(cart) {
    try {
        // Save cart to local storage
        localStorage.setItem(SIROKO_CART, JSON.stringify(cart));

        return true;

    } catch (e) {
        console.log(e);
    }
}

</script>

<style scoped>

</style>
