<script setup>
import { RouterLink } from 'vue-router';
import { useAuthStore } from '../stores/auth.js';
import { ref } from 'vue';
import NotificationIcon from '../components/NotificationIcon.vue';

const menu = ref(false)
const auth = useAuthStore();
</script>

<template>
    <nav class="top-0 z-20 w-full bg-gray-900 border-b border-gray-200 start-0 dark:border-gray-600">
        <div class="flex flex-wrap justify-between max-w-screen-xl px-2 py-4 mx-auto lg:p-4">

            <div class="flex lg:order-1">
                <div class="flex gap-2">
                    <button @click="menu = true" data-collapse-toggle="navbar-sticky" type="button"
                        class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden"
                        aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                    <p class="self-center text-lg font-semibold text-white whitespace-nowrap md:hidden">R6
                        Marketplace</p>
                </div>

                <div class="hidden lg:block">
                    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                        <span class="self-center text-2xl font-semibold text-white whitespace-nowrap">R6 Marketplace</span>
                    </a>
                </div>

            </div>

            <div class="lg:hidden">
                <aside id="logo-sidebar" :class="{ 'transform-none': menu, '-translate-x-full': !menu }"
                    class="fixed top-0 left-0 z-40 w-64 h-screen pt-5 transition-transform bg-gray-800 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
                    aria-label="Sidebar">
                    <div class="h-full pb-4 overflow-y-auto">
                        <div class="flex gap-2 px-3 pb-4 border-b">
                            <div>
                                <button @click="menu = false" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div>
                                <a href="/" class="flex items-center space-x-2 rtl:space-x-reverse">
                                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-6" alt="Flowbite Logo">
                                    <span class="self-center text-lg font-semibold text-white whitespace-nowrap">R6
                                        Marketplace</span>
                                </a>
                            </div>
                        </div>

                        <ul class="mt-4 space-y-2 font-medium">
                            <li>
                                <RouterLink to="/market" class="flex items-center p-2 text-gray-900 rounded-lg group">
                                    <span class="flex-1 ml-3 text-white whitespace-nowrap">Market</span>
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div v-show="menu" @click="menu = false"
                    class="fixed inset-0 z-30 bg-gray-900 bg-opacity-50 dark:bg-opacity-80"></div>
            </div>

            <div class="flex justify-end space-x-1 lg:order-3 md:space-x-0 rtl:space-x-reverse">
                <div v-if="auth.isAuthenticated">
                    <NotificationIcon />
                </div>

                <RouterLink v-if="auth.isAuthenticated" to="/profile">
                    <button data-collapse-toggle="navbar-sticky" type="button"
                        class="inline-flex items-center justify-center w-10 h-10 text-sm text-gray-500 rounded-lg lg:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </button>
                </RouterLink>

                <RouterLink v-else to="/login">
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get
                        started</button>
                </RouterLink>
            </div>

            <div class="items-center justify-between hidden w-full md:block lg:ml-5 md:flex md:w-auto lg:order-2"
                id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <RouterLink to="/market"
                            class="block px-3 py-2 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                            Market</RouterLink>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-3 py-2 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">About</a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>

    <div>
        <slot />
    </div>
</template>