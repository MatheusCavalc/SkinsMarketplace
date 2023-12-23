<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';

const auth = useAuthStore();

const open = ref(false)
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
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
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
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </button>
        </div>

        <!--Modal-->
        <Transition>
            <div v-show="open"
                class="absolute hidden lg:block right-0 z-20 text-white border rounded-md bg-slate-900 overflow-auto w-44">
                <ul class="pb-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li class="flex justify-between text-white px-4 py-3 border-b bg-black">
                        <p class="">Credits
                        </p>

                        <p>{{ auth.userCredits }}</p>
                    </li>
                    <li>
                        <RouterLink to="/profile/skins" class="block px-4 py-2 hover:bg-black text-white">Skins
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/profile/buy" class="block px-4 py-2 hover:bg-black text-white">Buys
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/profile/sale" class="block px-4 py-2 hover:bg-black text-white">Sells
                        </RouterLink>
                    </li>
                    <li>
                        <RouterLink to="#" class="block px-4 py-2 hover:bg-black text-white">Account
                        </RouterLink>
                    </li>

                    <li>
                        <button @click="auth.clear()"
                            class="w-full text-left block px-4 py-2 hover:bg-black text-white">Sign
                            out</button>
                    </li>
                </ul>
            </div>
        </Transition>
    </div>

    <!--Page-->
    <Transition>
        <div v-show="open" class="fixed top-0 right-0 z-40 w-full h-screen overflow-hidden lg:hidden">
            <section class="h-full overflow-hidden bg-gray-900">
                <nav class="bg-gray-900 border-gray-200">
                    <div class="flex justify-end max-w-screen-xl gap-3 px-2 py-4 mx-auto">
                        <button @click="open = false" class="text-white ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </nav>

                <div class="text-white">
                    <ul class="py-2 text-base text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li class="flex justify-between text-white px-4 py-2 border-b bg-black">
                            <p class="">Credits
                            </p>

                            <p>{{ auth.userCredits }}</p>
                        </li>
                        <li>
                            <RouterLink to="/profile/skins" class="block px-4 py-2 hover:bg-black text-white">Skins
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/profile/buy" class="block px-4 py-2 hover:bg-black text-white">Buys
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink to="/profile/sale" class="block px-4 py-2 hover:bg-black text-white">Sells
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink to="#" class="block px-4 py-2 hover:bg-black text-white">
                                Account</RouterLink>
                        </li>
                        <li>
                            <button @click="auth.clear()"
                                class="w-full text-left block px-4 py-2 hover:bg-black text-white">Sign
                                out</button>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </Transition>
</template>