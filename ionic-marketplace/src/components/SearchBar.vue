<script setup lang="ts">
import CartSection from '@/components/Mobile/CartSection.vue';
import { useCartStore } from '@/stores/cart';
import http from "@/services/http";
import { ref } from "vue";

const cartInfos = useCartStore()

const search = ref('');
const itemsSearch = ref([])

const cart = ref(false)

const cartModal = ref(false)

async function searchItem() {
    try {
        const { data } = await http.get('/search/' + search.value);
        itemsSearch.value = data.data
    } catch (error: any) {
        console.log(error?.response?.data)
    }

    if (search.value == '') {
        itemsSearch.value = [];
    }
}

const getImageUrl = (imagePath: string) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const changeCart = () => {
    cart.value = !cart.value
    cartModal.value = !cartModal.value
}
</script>

<template>
    <div class="lg:relative">
        <div class="flex gap-4">
            <!-- Search Bar on Desktop Screens -->
            <div class="hidden w-80 md:block">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" v-model="search" @keyup="searchItem"
                        class="block w-full p-2.5 text-sm text-white bg-gray-900 border border-gray-300 rounded-lg ps-10"
                        placeholder="Search...">
                </div>
            </div>

            <!-- Cart Button on Desktop Screens -->
            <div class="bg-slate-900 rounded-lg border hidden md:block">
                <button @click="changeCart" data-collapse-toggle="navbar-sticky" type="button"
                    class="flex gap-1 items-center justify-center mt-1.5 px-5 text-lg text-white rounded-lg">
                    <p class="">R$ {{ cartInfos.cartTotal }}</p>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Search Options -->
        <div v-if="search && itemsSearch.length > 0"
            class="absolute z-20 w-80 mt-2 bg-slate-900 max-h-80 overflow-y-auto border rounded-md">
            <div>
                <p class="text-sm m-3">Weapons</p>
            </div>
            <ul>
                <li class="flex w-full gap-4 py-2 px-4 my-3 text-white cursor-pointer mb-3" v-for="item in itemsSearch"
                    :key="item.id">
                    <img :src="getImageUrl(item.image_path)" class="object-cover w-20 h-6" :alt="item.name">

                    <p>{{ item.name }}</p>
                </li>
            </ul>
        </div>

        <!-- Modal Cart Items -->
        <Transition>
            <div v-if="cart" class="absolute z-20 mt-2 right-0 hidden md:block">
                <div class="h-96 w-96 bg-slate-900 overflow-y-auto border rounded-md">
                    <p class="text-lg px-5 py-2">Cart</p>

                    <div v-if="cartInfos.cartItems.length > 0">
                        <div class="grid grid-cols-2 gap-4 mx-1 pb-3">
                            <div v-for="skin in cartInfos.cartItems" :key="skin.skin.id"
                                class="p-1 bg-gray-900 border shadow-lg rounded-xl">
                                <div class="py-3 p-1.5 rounded-lg cursor-pointer bg-black border border-gray-700">
                                    <img class="object-contain h-28 w-36" :src="getImageUrl(skin.skin.image_path)"
                                        :alt="skin.skin.name">
                                </div>

                                <div class="p-2">
                                    <div class="mb-2 text-lg font-bold text-white">{{ skin.skin.name }}</div>

                                    <div class="flex pb-2 border-b border-gray-600">
                                        <p class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">
                                            Mythic</p>

                                        <p class="text-white text-sm">
                                            | Season 6
                                        </p>
                                    </div>

                                    <div class="flex justify-between mt-2 text-white">
                                        <p>R$ {{ skin.price }}</p>
                                    </div>

                                    <div class="bg-red-700 text-center font-bold cursor-pointer rounded-xl"
                                        @click="cartInfos.removeFromCart(skin)">
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
                        <div class="bg-blue-700 mt-4 text-center rounded-xl p-2 m-4">
                            <RouterLink to="/checkout">
                                <p>Proceed to Buy</p>

                                <p>R$ {{ cartInfos.cartTotal }}</p>
                            </RouterLink>
                        </div>
                    </div>

                    <div v-else class="mt-20">
                        <p class="text-center text-lg font-bold">Your cart is empty</p>

                        <p class="mt-2 text-center px-10">Add the items you want to purchase from our inventory</p>
                    </div>
                </div>
            </div>
        </Transition>
    </div>

    <!-- Only Screen Mobile -->
    <!-- Icon Cart -->
    <div v-if="cartInfos.cartItems.length > 0" class="fixed bottom-20 right-4 lg:hidden z-30">
        <button @click="changeCart"
            class="relative flex gap-1 items-center justify-center bg-black border p-4 rounded-full mt-3 text-sm text-white">
            <p class="top-0.5 right-2 absolute">{{ cartInfos.cartItems.length }}</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
        </button>
    </div>

    <!-- Page Cart Items -->
    <Transition>
        <div v-show="cartModal" class="fixed top-0 z-40 w-full h-screen lg:hidden overflow-hidden">
            <CartSection @close-section="changeCart" />
        </div>
    </Transition>
</template>