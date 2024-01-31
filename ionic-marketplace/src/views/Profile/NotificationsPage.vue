<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { onIonViewWillEnter, onIonViewDidEnter, onIonViewWillLeave, onIonViewDidLeave } from '@ionic/vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useAuthStore } from '@/stores/auth';
import http from '../../services/http'
import { ref } from 'vue';
import moment from 'moment';
import LoadingSpinner from '@/components/LoadingSpinner.vue';

const user = useAuthStore()

const notifications = ref([])
const loading = ref(true)

async function loadDataNotification() {
    try {
        const { data } = await http.get("/user/notifications");
        notifications.value = data.data.notifications
        loading.value = false
        //console.log(data);
    } catch (error: any) {
        console.log(error?.response?.data);
    }
}


const timestamp = "2023-12-01T03:05:15.000000Z";

const isToday = (timestamp: any) => {
    const today = moment().startOf('day');
    const dateToCheck = moment(timestamp);

    return today.isSame(dateToCheck, 'day');
};

console.log(isToday(timestamp));

onIonViewWillEnter(() => {
    loadDataNotification()
})
</script>

<template>
    <IonPage>
        <AppLayout>
            <section v-if="loading" class="bg-gradient-to-b from-black to-gray-950">
                <LoadingSpinner />
            </section>

            <section v-else class="h-full px-3 pb-16 overflow-auto bg-gradient-to-b from-black to-gray-950">
                <nav class="">
                    <div class="flex justify-center gap-3 px-5 py-4">
                        <p class="text-xl font-bold text-white">Notifications</p>
                    </div>
                </nav>

                <div class="overflow-auto text-white">
                    <div class="mt-3 mb-3">
                        <p class="font-bold">Today</p>
                    </div>
                    <div class="pb-5 border-b">
                        <div v-for="notification in notifications" :key="notification.id">
                            <div v-if="isToday(notification.created_at)">
                                <div v-if="notification.seller_id == user.userId"
                                    class="flex gap-2 p-2 bg-black rounded-sm">
                                    <div class="grid content-center grid-cols-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                                        <p class="text-sm">Sale of</p>
                                        <p>{{ notification.skin.name }} confirmed</p>
                                    </div>
                                </div>

                                <div v-if="notification.buyer_id == user.userId"
                                    class="flex gap-2 p-2 rounded-sm bg-slate-900">
                                    <div class="grid content-center grid-cols-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                                        <p class="text-sm">Purchase of</p>
                                        <p>{{ notification.skin.name }} confirmed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 mb-3">
                        <p class="font-bold">Yesterday</p>
                    </div>
                    <div class="pb-5 border-b">
                        <div v-for="notification in notifications" :key="notification.id" class="mb-2">
                            <div v-if="!isToday(notification.created_at)">
                                <div v-if="notification.seller_id == user.userId"
                                    class="flex gap-2 p-2 bg-black rounded-sm">
                                    <div class="grid content-center grid-cols-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                                        <p class="text-sm">Sale of</p>
                                        <p>{{ notification.skin.name }} confirmed</p>
                                    </div>
                                </div>

                                <div v-if="notification.buyer_id == user.userId"
                                    class="flex gap-2 p-2 rounded-sm bg-slate-900">
                                    <div class="grid content-center grid-cols-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                                        <p class="text-sm">Purchase of</p>
                                        <p>{{ notification.skin.name }} confirmed</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</IonPage></template>