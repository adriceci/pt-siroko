<script setup>

import {onMounted, ref} from 'vue';
import Card from './Card.vue';
import axios from "axios";

const products = ref([]);

onMounted(async () => {
    const response = await axios.get('/api/products');
    products.value = response.data;
});

</script>

<template>
    <div>
        <h2 class="text-white font-bold text-2xl">Products</h2>
    </div>

    <div class="mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <Card v-for="product in products" :key="product.id" :product="product"/>
        </div>
    </div>
</template>

<style scoped>

</style>
