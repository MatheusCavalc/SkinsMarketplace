<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { onIonViewWillEnter, onIonViewDidEnter, onIonViewWillLeave, onIonViewDidLeave } from '@ionic/vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SearchSection from '@/components/Mobile/SearchSection.vue'
import SkinDetails from '@/components/Mobile/SkinDetails.vue';
import SkinInfos from '@/components/SkinInfos.vue';
import SearchBar from '@/components/SearchBar.vue';
import { useFunctionsStore } from '@/stores/functions';
import http from '@/services/http';
import { ref } from 'vue'
import ToastNotification from '@/components/ToastNotification.vue';
import LoadingSpinner from '@/components/LoadingSpinner.vue';
import UserCredits from '@/components/UserCredits.vue';

interface Skin {
    id: number;
    name: string;
    price: string;
    imagePath: string;
    skin: any[];
    showDetails: boolean;
}

const functions = useFunctionsStore()

const loading = ref<boolean>(true)

const searchSection = ref<boolean>(false)

const listSkins = ref<Skin[]>([])

const chooseSkin = ref<any>([])
const detailsOpen = ref<boolean>(false)

async function loadData(): Promise<void> {
    try {
        const { data } = await http.get("/home");
        listSkins.value = data.data.skins
        loading.value = false
    } catch (error: any) {
        console.log(error?.response?.data);
    }
}

const skins = listSkins.value.map(skin => ({
    ...skin,
    showDetails: ref(false)
}))

const getImageUrl = (imagePath: string) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const openDetails = (skin: Skin): void => {
    skin.showDetails = true
    chooseSkin.value = skin
    detailsOpen.value = true
}

const closeDetails = (skin: Skin): void => {
    skin.showDetails = false
    chooseSkin.value = []
    detailsOpen.value = false
}

onIonViewWillEnter(() => {
    loading.value = true
    loadData()
})
</script>

<template>
    <ion-page>
        <AppLayout>
            <section class="bg-black" v-if="loading">
                <LoadingSpinner />
            </section>

            <section v-else class="min-h-screen overflow-auto text-white bg-slate-900">

                <SearchBar />

                <div class="flex justify-between py-2 mx-3">
                    <div>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                        </button>
                    </div>

                    <UserCredits />

                    <div>
                        <button @click="searchSection = true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex gap-4 py-5 mx-3">
                    <p>Most popular</p>
                    <p>^</p>
                </div>

                <div class="flex justify-center">
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
                                    <p>R$ {{ skin.price }}</p>
                                </div>
                            </div>

                            <Transition>
                                <div class="fixed inset-0 z-40 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto lg:block top-7"
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
                    <div class="flex justify-center">
                        <div v-show="functions.toast"
                            class="fixed z-10 border rounded-md bottom-20 lg:border-none">
                            <ToastNotification />
                        </div>
                    </div>
                </Transition>
            </section>
        </AppLayout>

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
    </ion-page>
</template>
