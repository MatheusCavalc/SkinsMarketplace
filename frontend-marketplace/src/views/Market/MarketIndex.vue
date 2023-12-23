<script setup>
import HomeLayout from "../../layouts/HomeLayout.vue";
import LoadingSpinner from "../../components/LoadingSpinner.vue";
import SearchBar from "../../components/SearchBar.vue";
import SkinInfos from "../../components/SkinInfos.vue";
import SearchSection from "../../components/Mobile/SearchSection.vue";
import SkinDetails from '../../components/Mobile/SkinDetails.vue';
import ToastNotification from '../../components/ToastNotification.vue';
import http from "@/services/http.js";
import { useFunctionsStore } from "../../stores/functions";
import { onMounted, ref } from "vue";

const functions = useFunctionsStore()

const loading = ref(true)

const searchSection = ref(false)

const listSkins = ref([])

const chooseSkin = ref([])
const detailsOpen = ref(false)

async function loadData() {
    try {
        const { data } = await http.get("/home");
        listSkins.value = data.data.skins
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

const openDetails = (skin) => {
    skin.showDetails = true
    chooseSkin.value = skin
    detailsOpen.value = true
}

const closeDetails = (skin) => {
    skin.showDetails = false
    chooseSkin.value = []
    detailsOpen.value = false
}

onMounted(() => {
    loadData()
})
</script>

<template>
    <div class="relative">
        <HomeLayout>
            <section class="bg-black" v-if="loading">
                <LoadingSpinner />
            </section>

            <section v-else class="pb-20 bg-black">
                <div class="flex justify-end py-5 text-white lg:mx-4">
                    <SearchBar />

                    <div class="flex mx-4">
                        <button @click="searchSection = true" data-collapse-toggle="navbar-sticky" type="button"
                            class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-200 rounded-lg md:hidden"
                            aria-controls="navbar-sticky" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex justify-center lg:ml-64">
                    <div class="grid grid-cols-2 gap-1.5 mx-3 lg:grid-cols-4 pb-20">
                        <div v-for="skin in listSkins" :key="skin.skin.id"
                            class="relative p-1 rounded-md shadow-lg bg-slate-800">
                            <div class="py-4 p-1.5 rounded-lg cursor-pointer">
                                <img @click="openDetails(skin)" class="object-contain h-28 w-96"
                                    :src="getImageUrl(skin.skin.image_path)" :alt="skin.skin.name">
                            </div>

                            <div class="px-2 py-2">
                                <div class="mb-2 text-base font-bold text-white md:text-xl">{{ skin.skin.name }}</div>

                                <div class="flex pb-2 border-b border-gray-600">
                                    <p class="bg-yellow-400 text-white text-sm font-medium me-1 px-1.5 py-0.5 rounded ">
                                        Mythic</p>

                                    <p class="text-sm text-white">
                                        | Season 6
                                    </p>
                                </div>

                                <div class="flex justify-start pb-2 mt-2 text-white">
                                    <p>$ {{ skin.price }}</p>
                                </div>
                            </div>

                            <Transition>
                                <div class="fixed inset-0 z-40 flex items-center justify-center hidden overflow-hidden lg:block top-7"
                                    v-show="skin.showDetails">
                                    <SkinInfos :skin="skin" @close-section="closeDetails(skin)" />
                                </div>
                            </Transition>
                            <div v-show="skin.showDetails" class="fixed inset-0 z-30 hidden bg-black opacity-75 lg:block">
                            </div>

                        </div>
                    </div>
                </div>

                <Transition>
                    <div v-show="functions.toast"
                        class="fixed z-10 border rounded-md bottom-4 right-4 lg:border-none">
                        <ToastNotification />
                    </div>
                </Transition>
            </section>
        </HomeLayout>

        <Transition>
            <div v-show="searchSection" class="fixed top-0 z-20 w-full h-screen overflow-hidden lg:hidden">
                <SearchSection @close-section="searchSection = false" />
            </div>
        </Transition>

        <Transition>
            <div v-if="detailsOpen && chooseSkin" class="fixed top-0 z-50 w-full h-screen overflow-hidden lg:hidden">
                <SkinDetails :skin="chooseSkin" @close-section="closeDetails(chooseSkin)" />
            </div>
        </Transition>
    </div>
</template>