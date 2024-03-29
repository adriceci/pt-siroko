<script setup>

import CartCard from "./CartCard.vue";

let cart = getCart();

if (!cart) {
    window.location.href = '/login';
}

let products = JSON.parse(cart.products) || [];

let items = 0;
let total = 0;

products.forEach(product => {
    items += product.quantity;
    total += product.price * product.quantity;
});

total = total.toFixed(2);


</script>

<template>
    <div>
        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold text-white">Cart</h2>
            <div class="text-white bg-indigo-500 rounded-full w-6 h-6">
                <p class="ml-[.45rem]">{{ items }}</p>
            </div>
            <button
                class="ml-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="createCheckout()">Checkout
            </button>
        </div>

        <div v-if="products.length === 0">
            <p class="text-white">Your cart is empty</p>
        </div>

        <div v-else>
            <div v-for="product in products" :key="product.id">
                <CartCard :product="product"/>
            </div>
        </div>
        <p class="text-white font-bold rounded-md w-full bg-indigo-600 py-2 px-4 text-right">Total: {{ total }}€</p>

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

        if (cart === null) {
            window.location.href = '/login';
        }

        return JSON.parse(cart);

    } catch (e) {
        console.log(e);
    }
}

export async function setCart(cart, ordered = false) {
    try {
        // Save cart to local storage
        localStorage.setItem(SIROKO_CART, JSON.stringify(cart));

        const $payload = {
            cart_id: cart.cart_id,
            user_id: cart.user_id,
            products: cart.products,
            ordered: ordered,
        };

        await axios.put('/cart', $payload, {
            headers: {
                Authorization: `Bearer ${getToken()}`
            }
        }).then(response => {
            console.log(response.data);
            return true;
        }).catch(error => {
            console.log(error);
        });

    } catch (e) {
        console.log(e);
    }
}

export async function createCheckout() {
    const cart = getCart();

    const response = await axios.post(`/cart/${cart.cart_id}/checkout`, {}, {
        headers: {
            Authorization: `Bearer ${getToken()}`
        }
    });

    if (response.status === 200) {
        await createCart();
        window.location.href = '/';
    }
}

</script>

<style scoped>

</style>
