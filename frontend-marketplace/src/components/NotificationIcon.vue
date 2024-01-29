<script setup>
import NotificationSection from './Mobile/NotificationSection.vue';
import http from "@/services/http.js";
import { onMounted, ref } from 'vue';
import moment from 'moment'

const open = ref(false)

const notifications = ref([])
const user_id = ref('')

async function loadData() {
    try {
        const { data } = await http.get("/user/notifications");
        notifications.value = data.data.notifications
        user_id.value = data.data.user_id
    } catch (error) {
        console.log(error?.response?.data);
    }
}

onMounted(() => {
    loadData()
})
</script>

<template>
    <div class="relative">
        <!--ICON Mobile-->
        <div class="lg:hidden">
            <button @click="open = !open" data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center justify-center w-10 h-10 text-sm text-gray-500 rounded-lg lg:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>
        </div>

        <!--ICON-->
        <div class="hidden lg:block">
            <button @click="open = !open" data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg lg:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>
        </div>

        <!--Modal-->
        <Transition>
            <div v-show="open"
                class="absolute right-0 z-20 hidden overflow-auto text-white border rounded-md lg:block bg-slate-900 max-h-56 w-72">
                <div v-for="notification in notifications" :key="notification.id">
                    <div v-if="notification.seller_id == user_id" class="p-2 bg-black border-b rounded-md">
                        <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                        <p class="text-sm">Sale of</p>
                        <p>{{ notification.skin.name }} confirmed</p>
                    </div>

                    <div v-if="notification.buyer_id == user_id" class="p-2 border-b rounded-md bg-slate-900">
                        <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                        <p class="text-sm">Purchase of</p>
                        <p>{{ notification.skin.name }} confirmed</p>
                    </div>
                </div>
            </div>
        </Transition>
    </div>

    <!--Page-->
    <Transition>
        <div v-show="open" class="fixed top-0 right-0 z-40 w-full h-screen overflow-hidden lg:hidden">
            <NotificationSection :notifications="notifications" :user_id="user_id" @close-section="open = false" />
        </div>
    </Transition>
</template>