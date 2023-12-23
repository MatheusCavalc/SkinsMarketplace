<script setup>
import { useCartStore } from '../../stores/cart.js'

const cart = useCartStore()

const emit = defineEmits(['closeSection'])

const closeSection = () => {
    emit('closeSection');
};

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}
</script>

<template>
    <section class="h-full overflow-y-auto bg-gray-900">
        <nav class="bg-gray-900 border-gray-200">
            <div class="flex justify-between max-w-screen-xl gap-3 px-2 py-4 mx-auto">
                <p class="text-2xl">Cart</p>

                <button @click="closeSection" class="text-white ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-2">
                <div v-if="cart.cartItems.length > 0">
                    <div class="grid grid-cols-2 gap-4 mx-1 lg:grid-cols-4">
                        <div v-for="skin in cart.cartItems" :key="skin.skin.id"
                            class="relative flex-shrink-0 p-1 bg-gray-900 border shadow-lg rounded-xl">
                            <div class="py-3 p-1.5 rounded-lg cursor-pointer bg-black border border-gray-700">
                                <img class="object-contain h-28 w-72" :src="getImageUrl(skin.skin.image_path)"
                                    :alt="skin.skin.name">
                            </div>

                            <div class="p-2">
                                <div class="mb-2 font-bold text-white">{{ skin.skin.name }}</div>

                                <div class="flex pb-2 border-b border-gray-600">
                                    <p class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">
                                        Mythic</p>

                                    <p class="text-sm text-white">
                                        | Season 6
                                    </p>
                                </div>

                                <div class="flex justify-between mt-2 text-white">
                                    <p>R$ {{ skin.price }}</p>
                                </div>

                                <div class="mt-2 font-bold text-center bg-red-700 cursor-pointer rounded-xl"
                                    @click="cart.removeFromCart(skin)">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fixed bottom-0 left-0 flex justify-between w-full py-5 bg-black px-7 rounded-t-2xl">
                        <div>
                            <p class="text-sm">Total</p>

                            <p>R$ {{ cart.cartTotal }}</p>
                        </div>

                        <RouterLink to="/checkout" class="px-4 py-3 bg-blue-700 rounded-full">
                            <p>Checkout</p>
                        </RouterLink>
                    </div>
                </div>

                <div v-else class="mt-20">
                    <p class="text-lg font-bold text-center">Your cart is empty</p>

                    <p class="px-10 mt-2 text-center">Add the items you want to purchase from our inventory</p>
                </div>
            </div>
        </nav>

    </section>
</template>