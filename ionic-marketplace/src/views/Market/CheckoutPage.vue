<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { ref } from 'vue';
import CheckoutButton from '@/components/CheckoutButton.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useCartStore } from '@/stores/cart';
import LoadingSpinner from '@/components/LoadingSpinner.vue';

const cart = useCartStore()

const getImageUrl = (imagePath: any) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const loadingSpinner = ref(false)
</script>

<template>
    <ion-page>
        <AppLayout>
            <section v-if="loadingSpinner" class="h-screen bg-black">
                <LoadingSpinner />
            </section>

            <section v-else class="min-h-screen px-2 pb-20 text-white bg-black lg:px-20">
                <div v-if="cart.cartItems.length > 0">
                    <div class="flex justify-between py-5">
                        <p class="text-base font-bold">Completing Purchase</p>

                        <p>${{ cart.cartTotal }}</p>
                    </div>

                    <div class="gap-5 lg:flex">
                        <div class="pt-5 lg:w-2/3 lg:border-r">
                            <div v-for="item in cart.cartItems" :key="item.id" class="flex justify-between mb-3 lg:px-4">
                                <div class="flex gap-5">
                                    <div class="border rounded-md lg:px-5 bg-slate-900">
                                        <img :src="getImageUrl(item.skin.image_path)"
                                            class="object-contain w-32 h-20 py-2 lg:w-60 lg:h-40" :alt="item.name">
                                    </div>

                                    <div class="grid content-center grid-cols-1">
                                        <p class="text-sm font-bold lg:text-xl">{{ item.skin.name }}</p>

                                        <p class="text-sm lg:text-lg">
                                            R$ {{ item.price }}
                                        </p>
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                        <div class="p-3 mt-10 rounded-md lg:w-1/3 bg-slate-900 lg:h-48 lg:mt-0">
                            <div class="lg:mt-16">
                                <CheckoutButton @checkout-init="loadingSpinner = true" />
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="grid content-center h-screen grid-cols-1">
                    <div>
                        <p class="text-lg font-bold text-center">Your cart is empty</p>

                        <p class="px-10 mt-2 text-center">Add the items you want to purchase from our inventory</p>

                        <div class="flex justify-center mx-5 mt-5">
                            <RouterLink to="/market"
                                class="w-full p-4 font-bold text-center text-white rounded-md bg-slate-900">
                                Back to market
                            </RouterLink>
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>
    </ion-page>
</template>