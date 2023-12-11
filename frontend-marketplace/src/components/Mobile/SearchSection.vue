<script setup>
import http from "@/services/http.js";
import { ref } from 'vue';

const emit = defineEmits(['closeSection'])

const closeSection = () => {
    emit('closeSection');
};

const search = ref('');
const itemsSearch = ref([])

async function searchItem() {
    try {
        const { data } = await http.get('/search/' + search.value);
        itemsSearch.value = data.data
    } catch (error) {
        console.log(error?.response?.data)
    }

    if (search.value == '') {
        itemsSearch.value = [];
    }
}

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}
</script>

<template>
    <section class="h-full overflow-hidden bg-gray-900">
        <nav class="bg-gray-900 border-gray-200">
            <div class="flex max-w-screen-xl gap-3 px-2 py-4 mx-auto">
                <button @click="closeSection" class="text-white ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                </button>
                <div class="flex w-full" id="navbar-search">
                    <div class="relative w-full md:hidden">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="search-navbar" v-model="search" @keyup="searchItem"
                            class="block w-full p-2 text-sm text-white bg-gray-900 border border-gray-300 rounded-lg ps-10 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search...">

                    </div>
                </div>
            </div>

            <ul v-if="search" class="absolute w-full mt-2 left-1">
                <li class="flex w-full gap-4 py-2 px-4 my-3 text-white cursor-pointer mb-3" v-for="item in itemsSearch"
                    :key="item.id">
                    <img :src="getImageUrl(item.image_path)" class="object-cover w-20 h-6" alt="">

                    <p>{{ item.name }}</p>
                </li>
            </ul>
        </nav>

    </section>
</template>