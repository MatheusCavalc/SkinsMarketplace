<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { onIonViewWillEnter, onIonViewDidEnter, onIonViewWillLeave, onIonViewDidLeave } from '@ionic/vue';
import AppLayout from '../../layouts/AppLayout.vue'
import LoadingSpinner from '../../components/LoadingSpinner.vue';
import SkinModal from '../../components/Profile/SkinModal.vue';
import SkinDetailsUser from '../../components/Profile/SkinDetailsUser.vue'
import http from "@/services/http";
import { ref } from "vue";

const loading = ref(true)

const listSkins = ref([])

const open = ref(false)

const chooseSkin = ref<any>([])
const detailsOpen = ref<boolean>(false)

const selectedMenu = ref('')

async function allSkins() {
    try {
        loading.value = true
        const { data } = await http.get("/user/skins");
        listSkins.value = data.data
        loading.value = false
    } catch (error: any) {
        console.log(error?.response?.data);
    }
}

async function allSkinsForSale() {
    try {
        loading.value = true
        const { data } = await http.get("/user/skins/sale");
        listSkins.value = data.data
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

const openDetails = (skin: any): void => {
    skin.showDetails = true
    chooseSkin.value = skin
    detailsOpen.value = true
}

const closeDetails = (skin: any): void => {
    skin.showDetails = false
    chooseSkin.value = []
    detailsOpen.value = false
}

onIonViewWillEnter(() => {
    detailsOpen.value = false
    chooseSkin.value = []
    loading.value = true
    selectAllSkins()
})
</script>

<template>
    <IonPage>
        <AppLayout>
            <section class="bg-slate-900" v-if="loading">
                <LoadingSpinner />
            </section>

            <section v-else class="h-screen text-white bg-slate-900">
                <div class="flex gap-4 px-8 py-10 lg:px-10 lg:gap-2">
                    <p class="text-xl font-bold lg:text-3xl">My Skins</p>

                    <div class="relative z-30 w-40 lg:mt-1">
                        <div class="block">
                            <div class="flex justify-between px-3 border rounded-lg cursor-pointer" @click="open = !open">
                                <p class="text-lg">{{ selectedMenu }}</p>

                                <button class="transition duration-300 ease-in-out"
                                    :class="{ 'rotate-180': open, 'rotate-0': !open }">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </div>

                            <Transition>
                                <div v-show="open"
                                    class="absolute flex flex-col w-40 px-5 mt-1 overflow-y-auto bg-black border rounded-lg shadow-xl top-8">
                                    <p @click="selectAllSkins()" class="w-full py-2 text-lg border-b cursor-pointer">
                                        All Skins
                                    </p>
                                    <p @click="selectForSaleSkin()" class="w-full py-2 text-lg cursor-pointer">For
                                        Sale
                                    </p>
                                </div>
                            </Transition>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="flex justify-center">
                        <div class="grid grid-cols-2 gap-4 mx-4 lg:grid-cols-4">
                            <div v-for="skin in listSkins" :key="skin.id"
                                class="relative p-1 bg-gray-900 border shadow-lg rounded-xl">
                                <div class="py-4 p-1.5 rounded-lg cursor-pointer bg-black border border-gray-700">
                                    <img @click="openDetails(skin)" class="object-contain h-28 w-96"
                                        :src="getImageUrl(skin.image_path)" :alt="skin.name">
                                </div>

                                <div class="px-2 py-2">
                                    <div class="mb-2 text-base font-bold text-white md:text-xl">{{ skin.name }}</div>

                                    <div class="flex pb-2 border-b border-gray-600">
                                        <p class="bg-yellow-400 text-white text-sm font-medium me-1 px-1.5 py-0.5 rounded ">
                                            Mythic</p>

                                        <p class="text-sm text-white">
                                            | Season 6
                                        </p>
                                    </div>
                                </div>

                                <Transition>
                                    <div class="fixed inset-0 z-40 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto lg:block top-7"
                                        v-show="skin.showDetails">
                                        <SkinModal :skin="skin" @reload-data="reloadData"
                                            @close-section="skin.showDetails = false" />
                                    </div>
                                </Transition>
                                <div v-show="skin.showDetails"
                                    class="fixed inset-0 z-30 hidden bg-black opacity-75 lg:block">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>

        <Transition>
            <div v-if="detailsOpen && chooseSkin" class="fixed top-0 z-50 w-full h-screen overflow-hidden lg:hidden">
                <SkinDetailsUser :skin="chooseSkin" @close-section="closeDetails(chooseSkin)" @reload-data="reloadData" />
            </div>
        </Transition>
    </IonPage>
</template>
