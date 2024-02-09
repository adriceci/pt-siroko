<script setup>

console.log('Cart.vue');

</script>

<template>
    <a href="/cart"
       class="mt-8 ml-auto w-[50px] flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Cart
    </a>
</template>

<script>
export async function createCart(token) {
    // Create a new cart
    const response = await axios.post('/cart', {}, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });

    // Save cart to local storage
    localStorage.setItem('siroko_cart', JSON.stringify(response.data));
}

</script>

<style scoped>

</style>
