<script setup>
import HomeLayout from '../../layouts/HomeLayout.vue'
import LoadingSpinner from '../../components/LoadingSpinner.vue';
import SkinModal from '../../components/Profile/SkinModal.vue'
import http from "@/services/http.js";
import { onMounted, ref } from "vue";

const loading = ref(true)

const listSkins = ref([])

const open = ref(false)

const selectedMenu = ref('')

async function allSkins() {
    try {
        loading.value = true
        const { data } = await http.get("/user/skins");
        listSkins.value = data.data
        loading.value = false
    } catch (error) {
        console.log(error?.response?.data);
    }
}

async function allSkinsForSale() {
    try {
        loading.value = true
        const { data } = await http.get("/user/skins/sale");
        listSkins.value = data.data
        loading.value = false
    } catch (error) {
        console.log(error?.response?.data);
    }
}

const skins = listSkins.value.map(skin => ({
    ...skin,
    showDetails: ref(false)
}))

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const selectAllSkins = () => {
    allSkins()
    open.value = false
    selectedMenu.value = 'All Skins'
}

const selectForSaleSkin = () => {
    allSkinsForSale()
    open.value = false
    selectedMenu.value = 'For Sale'
}

const reloadData = () => {
    if (selectedMenu.value == 'For Sale') {
        allSkinsForSale()
    } else {
        allSkins()
    }
}

onMounted(() => {
    selectAllSkins()
})
</script>

<template>
    <HomeLayout>
        <section class="bg-gradient-to-b from-black to-gray-950" v-if="loading">
            <LoadingSpinner />
        </section>

        <section v-else class="min-h-screen pb-20 text-white bg-gradient-to-b from-black to-gray-950">
            <div class="px-8 lg:px-10 py-10 flex gap-4 lg:gap-2">
                <p class="text-2xl lg:text-3xl font-bold">My Skins</p>

                <div class="relative z-30 w-40 lg:mt-1">
                    <div class="block">
                        <div class="flex justify-between px-3 cursor-pointer border rounded-lg" @click="open = !open">
                            <p class="text-lg">{{ selectedMenu }}</p>

                            <button class="transition ease-in-out duration-300"
                                :class="{ 'rotate-180': open, 'rotate-0': !open }">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>

                        <Transition>
                            <div v-show="open"
                                class="absolute px-5 mt-1 border top-8 bg-black w-40 overflow-y-auto rounded-lg shadow-xl flex flex-col">
                                <p @click="selectAllSkins()" class="text-lg cursor-pointer w-full py-2 border-b">
                                    All Skins
                                </p>
                                <p @click="selectForSaleSkin()" class="text-lg cursor-pointer w-full py-2">For
                                    Sale
                                </p>
                            </div>
                        </Transition>
                    </div>
                </div>
            </div>

            <div class="">
                <div class="flex justify-center">
                    <div class="grid grid-cols-1 gap-4 mx-4 lg:grid-cols-4">
                        <div v-for="skin in listSkins" :key="skin.id"
                            class="relative flex-shrink-0 p-1 bg-gray-900 border shadow-lg w-80 rounded-xl">
                            <div class="py-14 p-1.5 rounded-lg cursor-pointer bg-black border border-gray-700">
                                <img @click="skin.showDetails = true" class="object-contain h-28 w-96"
                                    :src="getImageUrl(skin.image_path)" :alt="skin.name">
                            </div>

                            <div class="px-6 py-4">
                                <div class="mb-2 text-xl font-bold text-white">{{ skin.name }}</div>

                                <div class="flex pb-2 border-b border-gray-600">
                                    <p class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">
                                        Mythic</p>

                                    <p class="text-white">
                                        | Season 6
                                    </p>
                                </div>

                                <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                                    <p>Last sold at:</p>
                                    <p>{{ skin.pivot.price }}</p>
                                </div>

                                <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                                    <p>Current price range:</p>
                                    <p class="text-sm">120 - 500</p>
                                </div>

                                <div class="flex justify-between mt-2 text-white">
                                    <p>Sale order:</p>
                                    <p>64</p>
                                </div>
                            </div>

                            <Transition>
                                <div class="hidden lg:block top-7 fixed inset-0 z-40 flex items-center justify-center overflow-x-hidden overflow-y-auto"
                                    v-show="skin.showDetails">
                                    <SkinModal :skin="skin" @reload-data="reloadData"
                                        @close-section="skin.showDetails = false" />
                                </div>
                            </Transition>
                            <div v-show="skin.showDetails" class="hidden lg:block fixed inset-0 z-30 bg-black opacity-75">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>

<style scoped>
.bg-home {
    background-size: cover;
    background-position: center;
    width: 100%;
    background-image: linear-gradient(#000000bb, #000000bb), url('../assets/images/bg-image.webp');
    background-repeat: no-repeat;
}
</style>