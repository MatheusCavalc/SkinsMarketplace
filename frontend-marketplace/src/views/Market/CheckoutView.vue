<script setup>
import { ref } from 'vue';
import CheckoutButton from '../../components/CheckoutButton.vue';
import HomeLayout from '../../layouts/HomeLayout.vue';
import { useCartStore } from '../../stores/cart';
import LoadingSpinner from '../../components/LoadingSpinner.vue';

const cart = useCartStore()

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const loadingSpinner = ref(false)
</script>

<template>
    <HomeLayout>
        <section v-if="loadingSpinner" class="h-screen bg-black">
            <LoadingSpinner />
        </section>

        <section v-else class="min-h-screen px-2 pb-20 text-white bg-black lg:px-20">

            <div class="py-8">
                <p class="text-2xl font-bold">Completing Purchase</p>
            </div>

            <div class="gap-5 lg:flex">
                <div class="pt-5 lg:w-2/3 lg:border-r">
                    <div v-for="item in cart.cartItems" :key="item.id" class="flex justify-between mb-3 lg:px-4">
                        <div class="flex gap-5">
                            <div class="px-5 border rounded-md bg-slate-900">
                                <img :src="getImageUrl(item.skin.image_path)"
                                    class="object-contain w-32 h-20 py-2 lg:w-60 lg:h-40" :alt="item.name">
                            </div>

                            <div class="grid content-center grid-cols-1">
                                <p class="font-bold lg:text-xl">{{ item.skin.name }}</p>
                            </div>
                        </div>

                        <div class="grid content-center grid-cols-1">
                            <div class="flex gap-2">
                                <p class="font-bold lg:text-lg">
                                    R$ {{ item.price }}
                                </p>

                                <button class="font-bold"
                                    @click="cart.removeFromCart(item)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-48 p-5 mt-10 rounded-md lg:w-1/3 bg-slate-900 lg:mt-0">
                    <div class="flex justify-between">
                        <p class="font-bold">Subtotal</p>
                        <p>{{ cart.cartTotal }}</p>
                    </div>

                    <div class="mt-16">
                        <CheckoutButton @checkout-init="loadingSpinner = true" />
                    </div>
                </div>
            </div>
        </section>
</HomeLayout></template>