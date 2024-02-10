<script setup>

</script>

<template>
    <a href="/cart"
       class="mt-8 ml-auto w-[50px] flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Cart
    </a>
</template>

<script>

const SIROKO_CART = 'siroko_cart';

export async function createCart(token) {
    // Create a new cart
    const response = await axios.post('/cart', {}, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });

    // Save cart to local storage
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
