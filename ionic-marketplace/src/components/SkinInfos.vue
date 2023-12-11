<script setup lang="ts">
import { useCartStore } from '@/stores/cart'

const props = defineProps(['skin'])

const cart = useCartStore()

const emit = defineEmits(['closeSection'])

const closeSection = () => {
    emit('closeSection');
};

const getImageUrl = (imagePath: string) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const addToCart = (skin: any) => {
    cart.addToCart(skin)
    closeSection()
}
</script>

<template>
    <div class="relative w-4/5 lg:mx-auto lg:w-4/5">
        <div class="w-full bg-slate-900 px-5 py-7 rounded-md">
            <div class="flex justify-end">
                <button class="mr-5 lg:mr-5 text-white" @click="closeSection">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="lg:flex justify-evenly text-white">
                <div class="hidden lg:block w-3/5">
                    <div class="h-full content-center grid grid-cols-1">
                        <img class="object-cover w-full rounded-lg my-auto" :src="getImageUrl(skin.skin.image_path)"
                            :alt="skin.skin.name" />
                    </div>
                </div>

                <div class="w-2/5">
                    <div class="mx-4 mt-3 lg:mx-5">
                        <div class="flex">
                            <span class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                Mythic</span>

                            <p>| Season 6</p>
                        </div>

                        <div class="">
                            <p class="text-white text-lg lg:text-2xl">{{ skin.skin.name
                            }}
                            </p>
                        </div>

                        <div class="mt-5 p-5 bg-black text-white rounded-md">
                            <div class="">
                                <div class="flex justify-between">
                                    <p>Last sold at:</p>
                                    <p>{{ skin.price }}</p>
                                </div>

                                <div class="flex justify-between mt-3">
                                    <p>Current price range</p>
                                    <p class="text-sm">120 - 500</p>
                                </div>

                                <div class="flex justify-between mt-3">
                                    <p>Sale order:</p>
                                    <p>64</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 p-5 bg-black text-white rounded-md">
                            <div class="mb-3 pb-4 border-b">
                                <div class="flex justify-between">
                                    <p>Recommended price</p>

                                    <p>0</p>
                                </div>
                                <p class="text-lg mt-2 lg:text-sm pr-8">The price we
                                    recommend based
                                    on cs.money prices</p>
                            </div>

                            <div>
                                <p class="text-lg">Price</p>
                                <p class="text-lg lg:text-2xl">R$ {{ skin.price }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 flex-row-reverse mt-5 mr-2 lg:mr-5">
                        <button type="submit" @click="addToCart(skin)"
                            class="bg-blue-700 font-bold py-2 text-base tracking-tighter text-white rounded-full px-7">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>