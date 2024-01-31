<script setup lang="ts">
import AppLayout from '../../layouts/AppLayout.vue';
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { onIonViewWillEnter, onIonViewDidEnter, onIonViewWillLeave, onIonViewDidLeave } from '@ionic/vue';
import { useAuthStore } from '@/stores/auth';
import { useCartStore } from '@/stores/cart';
import { ref } from 'vue'

const auth = useAuthStore()
const cart = useCartStore()

const out = ref<boolean>(false)

const logout = () => {
    cart.clearCart()
    out.value = true
    auth.clear()
}

onIonViewWillEnter(() => {
    out.value = false
})
</script>

<template>
    <ion-page>
        <AppLayout>
            <section class="h-screen px-10 py-5 text-white bg-gradient-to-b from-black to-gray-950">
                <div>
                    <p class="text-xl font-bold text-center">My Account</p>
                </div>

                <div class="mt-10 lg:w-1/5 lg:mx-20">
                    <RouterLink to="/profile/skins" class="flex justify-between pb-3">
                        <div>
                            <p class="text-white">
                                Skins
                            </p>
                        </div>
                        <div>
                            <p class="text-white">
                                >
                            </p>
                        </div>
                    </RouterLink>

                    <RouterLink to="/" class="flex justify-between pb-3 mt-3">
                        <div>
                            <p class="text-white">
                                Buys
                            </p>
                        </div>
                        <div>
                            <p class="text-white">
                                >
                            </p>
                        </div>
                    </RouterLink>

                    <RouterLink to="/" class="flex justify-between pb-3 mt-3">
                        <div>
                            <p class="text-white">
                                Sells
                            </p>
                        </div>
                        <div>
                            <p class="text-white">
                                >
                            </p>
                        </div>
                    </RouterLink>

                    <div class="flex justify-between pb-3 mt-3">
                        <div>
                            <p class="text-base">
                                Account
                            </p>
                        </div>
                        <div>
                            <p class="text-base">
                                >
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-center w-full mt-5">
                        <button @click="logout" :disabled="out" class="w-full py-4 font-bold text-center text-white bg-blue-600 rounded-md">
                            <p v-if="!out">
                                Sign out
                            </p>

                            <p v-else>
                                <svg aria-hidden="true"
                                    class="inline w-4 h-3 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                            </p>
                        </button>
                    </div>
            </div>
        </section>
    </AppLayout>
</ion-page></template>