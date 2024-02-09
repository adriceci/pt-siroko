<script setup>

import {ref} from "vue";
import axios from "axios";

const email = ref('');
const password = ref('');

async function login() {

    if (email.value === '' || password.value === '') {
        return;
    }

    const $payload = {
        email: email.value,
        password: password.value
    }

    await axios.post('/user/auth', $payload).catch((error) => {
        console.log(error);
    }).then((response) => {
        // Save token to local storage
        localStorage.setItem('siroko_token', response.data.data.token);
        // Redirect to home
        window.location.href = '/';
    });
}

</script>

<template>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
            Email address
        </label>
        <div class="mt-1">
            <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                required
                class="py-2 px-4 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 dark:focus:ring-opacity-50"
                v-model="email"
            >
        </div>
    </div>

    <div class="mt-6">
        <label for="password"
               class="block text-sm font-medium text-gray-700 dark:text-gray-200">
            Password
        </label>
        <div class="mt-1">
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="py-2 px-4 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-gray-100 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 dark:focus:ring-opacity-50"
                v-model="password"
            >
        </div>
    </div>

    <div>
        <button type="submit"
                class="mt-6 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                @click="login"
        >
            Sign in
        </button>
    </div>
</template>

<style scoped>

</style>
