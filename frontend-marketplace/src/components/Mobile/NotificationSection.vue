<script setup>
import moment from 'moment';
const props = defineProps(['notifications', 'user_id'])
const emits = defineEmits(['closeSection'])
</script>

<template>
    <section class="h-full overflow-hidden bg-gray-900">
        <nav class="bg-gray-900 border-gray-200">
            <div class="flex max-w-screen-xl gap-3 px-2 py-4 mx-auto">
                <button @click="emits('closeSection')" class="text-white ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                </button>

                <p class="text-lg text-white">Your Notifications</p>
            </div>
        </nav>

        <div class="text-white">
            <div v-for="notification in notifications" :key="notification.id">
                <div v-if="notification.seller_id == user_id" class="p-2 bg-black border-b">
                    <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                    <p class="text-sm">Sale of</p>
                    <p>{{ notification.skin.name }} confirmed</p>
                </div>

                <div v-if="notification.buyer_id == user_id" class="p-2 border-b bg-slate-900">
                    <p class="text-sm">{{ moment(notification.created_at).format('MMMM Do YYYY, h:mm:ss a') }}</p>
                    <p class="text-sm">Purchase of</p>
                    <p>{{ notification.skin.name }} confirmed</p>
                </div>
            </div>
        </div>
    </section>
</template>