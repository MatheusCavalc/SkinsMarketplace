<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import MarketIcon from '@/icons/MarketIcon.vue'
</script>

<template>
    <ion-page>
        <nav class="fixed bottom-0 z-10 w-full bg-black text-white pt-2 pb-3 rounded-t-3xl">
            <div class="flex justify-between">
                <RouterLink to="/market" class="w-1/4">
                    <div class="flex justify-center text-white">
                        <MarketIcon />
                    </div>
                    <p class="text-sm text-center text-white">Market</p>
                </RouterLink>
                <div class="w-1/4">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                        </svg>
                    </div>
                    <p class="text-sm text-center">Latest</p>
                </div>
                <RouterLink to="/notifications" class="w-1/4">
                    <div class="flex justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                    <p class="text-sm text-center text-white">Notifications</p>
                </RouterLink>
                <RouterLink to="/profile" class="w-1/4 text-white">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <p class="text-sm text-center">Account</p>
                </RouterLink>
            </div>
        </nav>

        <slot />
    </ion-page>
</template>
