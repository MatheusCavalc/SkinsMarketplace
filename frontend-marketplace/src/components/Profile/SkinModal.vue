<script setup>
import http from "@/services/http.js";
import { reactive } from 'vue';

const props = defineProps(['skin'])

const emit = defineEmits(['closeSection', 'reloadData'])

const getImageUrl = (imagePath) => {
    return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

let skinDetails = reactive({
    price: props.skin.pivot.price,
    for_sale: props.skin.pivot.for_sale == 1 ? true : false
});

async function changeStatus() {
    try {
        const { data } = await http.put("/skin/" + props.skin.pivot.id, skinDetails);
        if (data.message == "Update Skin") {
            emit('reloadData');
            emit('closeSection');
        }
    } catch (error) {
        console.log(error?.response?.data);
    }
}
</script>

<template>
    <div class="relative w-4/5 lg:mx-auto lg:w-4/5">
        <div class="w-full px-5 rounded-md bg-slate-900 py-7">
            <div class="flex justify-end">
                <button class="mr-5 text-white lg:mr-5" @click="emit('closeSection')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="text-white lg:flex justify-evenly">
                <div class="hidden w-3/5 lg:block">
                    <div class="grid content-center h-full grid-cols-1">
                        <img class="object-cover w-full my-auto rounded-lg" :src="getImageUrl(skin.image_path)"
                            :alt="skin.name" />
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
                            <p class="text-lg text-white lg:text-2xl">{{ skin.name }}</p>
                        </div>

                        <div class="mt-10">
                            <form @submit.prevent="changeStatus">
                                <div>
                                    <label for="small-input" class="block mb-2 font-medium text-white">Skin
                                        Price</label>
                                    <input type="text" id="small-input" v-model="skinDetails.price"
                                        class="block w-full p-2 text-white bg-gray-700 border border-gray-300 rounded-lg">
                                </div>

                                <div class="flex items-start mt-5">
                                    <div class="flex items-center h-5 mt-0.5">
                                        <input type="checkbox" v-model="skinDetails.for_sale"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50">
                                    </div>
                                    <label for="remember" class="font-medium text-gray-300 ms-2">For Sale</label>
                                </div>

                                <div class="flex flex-row-reverse gap-2 mt-5 mr-2 lg:mr-5">
                                    <button type="submit"
                                        class="py-2 text-base font-bold tracking-tighter text-white bg-blue-700 rounded-full px-7">
                                        Change
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>