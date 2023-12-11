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
        <section v-if="loadingSpinner" class="bg-black h-screen">
            <LoadingSpinner />
        </section>

        <section v-else class="px-2 lg:px-20 bg-black text-white min-h-screen pb-20">

            <div class="py-14">
                <p class="text-2xl font-bold">Completing Purchase</p>
            </div>

            <div class="lg:flex gap-5">
                <div class="lg:w-2/3 pt-5 lg:border-r">
                    <div v-for="item in cart.cartItems" :key="item.id" class="flex mb-3 justify-between lg:px-4">
                        <div class="flex gap-5">
                            <div class="bg-slate-900 px-5 border rounded-md">
                                <img :src="getImageUrl(item.skin.image_path)" class="object-contain w-32 h-20 lg:w-60 lg:h-40 py-2"
                                    :alt="item.name">
                            </div>

                            <div class="grid grid-cols-1 content-center">
                                <p class="lg:text-xl font-bold">{{ item.skin.name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 content-center">
                            <div class="flex gap-2">
                                <p class="lg:text-lg font-bold">
                                    R$ {{ item.price }}
                                </p>

                                <button class="text-red-700 font-bold lg:border lg:rounded-md" @click="cart.removeFromCart(item)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3 bg-slate-900 p-5 h-48 rounded-md mt-10 lg:mt-0">
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
    </HomeLayout>
</template>