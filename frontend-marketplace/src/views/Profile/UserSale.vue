<script setup>
import HomeLayout from "../../layouts/HomeLayout.vue";
import LoadingSpinner from "../../components/LoadingSpinner.vue";
import http from "@/services/http.js";
import { onMounted, ref } from 'vue';

const list = ref([])

const loading = ref(true)

async function getSale() {
    try {
        loading.value = true
        const { data } = await http.get("/user/sale");
        list.value = data.data
        loading.value = false
    } catch (error) {
        console.log(error?.response?.data);
    }
}

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

onMounted(() => {
    getSale()
})
</script>

<template>
    <HomeLayout>
        <section v-if="loading" class="bg-black h-screen">
            <LoadingSpinner />
        </section>

        <section v-else class="bg-black h-screen text-white">
            <div class="p-5 lg:p-10">
                <p class="text-2xl font-bold">My Last Sells</p>
            </div>

            <div v-for="skin in list" :key="skin.id" class="flex justify-between border-b py-4 px-2 lg:px-10">
                <div class="mr-2 lg:mr-20">
                    <img class="w-32 h-20 lg:w-72 lg:h-40 object-contain lg:border rounded-md"
                        :src="getImageUrl(skin.skin.image_path)" alt="">
                </div>

                <div class="grid grid-cols-1 content-center lg:mr-5">
                    <p class="font-bold lg:text-lg">{{ skin.skin.name }}</p>
                    <p>Price: {{ skin.price }}</p>
                </div>

                <!--
                <div class="grid grid-cols-1 content-center">
                    <p>Buy Date:</p>
                    <p>{{ skin.created_at }}</p>
                </div>
                -->

                <div class="grid grid-cols-1 content-center">
                    <button type="submit"
                        class="py-2 text-base font-bold tracking-tighter text-white bg-blue-700 rounded-full px-2 lg:px-7">
                        Details
                    </button>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>