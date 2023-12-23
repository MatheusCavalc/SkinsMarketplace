<script setup lang="ts">
import { useCartStore } from '@/stores/cart'
import { onIonViewWillEnter, onIonViewDidEnter, onIonViewWillLeave, onIonViewDidLeave } from '@ionic/vue';
import router from '@/router';
import AppLayout from '@/layouts/AppLayout.vue';

const cart = useCartStore()

const emit = defineEmits(['closeSection'])

const closeSection = () => {
    emit('closeSection'); 
};

const getImageUrl = (imagePath: string) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const checkout = () => {
    router.push({ name: "checkout" });
}

onIonViewWillLeave(() => {
    emit('closeSection')
})
</script>

<template>
    <AppLayout>
        <section class="z-50 h-full overflow-y-auto text-white bg-gray-900">
            <nav class="bg-gray-900 border-gray-200">
                <div class="flex justify-between max-w-screen-xl gap-3 px-2 py-4 mx-auto">
                    <p class="text-xl">Cart</p>

                    <RouterLink to="/market" class="text-white ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </RouterLink>
                </div>

                <div class="px-2">
                    <div v-if="cart.cartItems.length > 0">

                        <div v-for="item in cart.cartItems" :key="item.id" class="flex justify-between mb-3 lg:px-4">
                            <div class="flex gap-5">
                                <div class="border rounded-md lg:px-5 bg-slate-900">
                                    <img :src="getImageUrl(item.skin.image_path)" class="object-contain w-32 h-20 py-2 lg:w-60 lg:h-40"
                                        :alt="item.name">
                                </div>

                                <div class="grid content-center grid-cols-1">
                                    <p class="text-sm font-bold lg:text-xl">{{ item.skin.name }}</p>

                                    <p class="text-sm lg:text-lg">
                                        R$ {{ item.price }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid content-center grid-cols-1">
                                <div class="flex justify-end gap-2">

                                    <button class="font-bold text-white lg:border lg:rounded-md"
                                        @click="cart.removeFromCart(item)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="fixed bottom-0 left-0 flex justify-between w-full py-5 bg-black px-7 rounded-t-2xl">
                            <div>
                                <p class="text-sm">Total</p>

                                <p>R$ {{ cart.cartTotal }}</p>
                            </div>

                            <button @click="checkout" class="px-4 bg-blue-700 rounded-full">
                                <p>Checkout</p>
                            </button>
                        </div>
                    </div>

                    <div v-else class="mt-20">
                        <p class="text-lg font-bold text-center">Your cart is empty</p>

                        <p class="px-10 mt-2 text-center">Add the items you want to purchase from our inventory</p>
                    </div>
                </div>
            </nav>

        </section>
    </AppLayout>
</template>