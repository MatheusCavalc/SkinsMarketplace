<script setup>
import { useCartStore } from '../../stores/cart.js'

const props = defineProps(['skin'])

const cart = useCartStore()

const emit = defineEmits(['closeSection'])

const closeSection = () => {
    emit('closeSection');
};

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

const addToCart = (skin) => {
    cart.addToCart(skin)
    closeSection()
}
</script>

<template>
    <section v-if="props.skin" class="h-full overflow-y-hidden bg-gray-900">
        <nav class="bg-gray-900 border-gray-200">
            <div class="flex justify-start max-w-screen-xl gap-3 px-2 py-4 mx-auto">
                <button @click="closeSection" class="text-white ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                </button>
            </div>
        </nav>

        <div class="text-white">
            <div class="py-7 px-2">
                <div v-if="skin" class="h-full content-center grid grid-cols-1">
                    <img class="object-cover w-full rounded-lg my-auto" :src="getImageUrl(skin.skin.image_path)"
                        :alt="skin.skin.name" />
                </div>
            </div>

            <div class="">
                <div class="mx-4 mt-3 lg:mx-5">
                    <div class="flex">
                        <span class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                            Mythic</span>

                        <p class="text-sm">| Season 6</p>
                    </div>

                    <div class="">
                        <p class="text-white text-2xl">{{ skin.skin.name }}
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
                            <p class="mt-2 text-sm pr-8">The price we
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

    </section>
</template>