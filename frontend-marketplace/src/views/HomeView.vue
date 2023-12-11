<script setup>
import HomeLayout from '../layouts/HomeLayout.vue';
import HomeWelcome from '../components/HomeWelcome.vue';
import http from "@/services/http.js";
import { onMounted, ref } from "vue";

const listSkins = ref([])

async function list() {
  try {
    const { data } = await http.get("/home");
    console.log(data.data.skins)

    listSkins.value = data.data.skins
  } catch (error) {
    console.log(error?.response?.data);
  }
}

const getImageUrl = (imagePath) => {
  return `http://localhost:8000/storage${imagePath.replace(/^public\//, '/')}`;
}

onMounted(() => {
  list()
})
</script>

<template>
  <HomeLayout>
    <section class="bg-black">

      <HomeWelcome />

      <div class="py-10 mx-5 mt-10 lg:py-20">
        <div class="gap-20 p-4 border rounded-lg lg:flex lg:justify-evenly bg-gray-950">
          <div class="order-1 mt-10 lg:mt-32 lg:order-2">
            <p class="text-3xl text-white lg:text-5xl">Check the app and</p>
            <p class="text-3xl text-white lg:text-5xl">buy skins anywhere</p>

            <div class="mt-5">
              <RouterLink to="/market">
                <button type="button"
                  class="py-2.5 px-5 me-2 mb-2 text-base lg:text-lg font-medium text-gray-900 focus:outline-none bg-white hover:bg-black rounded-full border border-gray-200 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-200">Learn
                  More</button>
              </RouterLink>
            </div>
          </div>

          <div class="flex order-2 mt-8 lg:order-1">
            <img class="w-1/2 lg:w-60" src="https://cs.money/img/main/webp/mobile_cart.webp" alt="">
            <img class="w-1/2 lg:w-60" src="https://cs.money/img/main/webp/mobile_inventory.webp" alt="">
          </div>
        </div>
      </div>

      <div class="py-10 mx-5 mt-10 lg:mx-20 lg:py-20">
        <div>
          <p class="text-4xl font-bold text-white">Latest Items Added</p>
        </div>

        <div class="flex w-full gap-2 pb-5 mt-5 overflow-x-auto">

          <div v-for="skin in listSkins" :key="skin.id"
            class="flex-shrink-0 p-1 bg-gray-900 border shadow-lg w-72 lg:w-80 rounded-xl min-w-80">
            <div class="py-14 p-1.5 rounded-lg bg-black border border-gray-700">
              <img class="object-contain h-28 w-96" :src="getImageUrl(skin.skin.image_path)"
                :alt="skin.skin.name">
            </div>

            <div class="px-6 py-4">
              <div class="mb-2 text-xl font-bold text-white">{{ skin.skin.name }}</div>

              <div class="flex pb-2 border-b border-gray-600">
                <p class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">
                  Mythic</p>

                <p class="text-white">
                  | Season 6
                </p>
              </div>

              <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                <p>Last sold at:</p>
                <p>{{ skin.price }}</p>
              </div>

              <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                <p>Current price range:</p>
                <p class="text-sm">120 - 500</p>
              </div>

              <div class="flex justify-between mt-2 text-white">
                <p>Sale order:</p>
                <p>64</p>
              </div>
            </div>

          </div>

          <div v-for="skin in listSkins" :key="skin.id"
            class="flex-shrink-0 p-1 bg-gray-900 border shadow-lg w-72 lg:w-80 rounded-xl min-w-80">
            <div class="py-14 p-1.5 rounded-lg bg-black border border-gray-700">
              <img class="object-contain h-28 w-96" :src="getImageUrl(skin.skin.image_path)"
                :alt="skin.skin.name">
            </div>

            <div class="px-6 py-4">
              <div class="mb-2 text-xl font-bold text-white">{{ skin.skin.name }}</div>

              <div class="flex pb-2 border-b border-gray-600">
                <p class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">
                  Mythic</p>

                <p class="text-white">
                  | Season 6
                </p>
              </div>

              <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                <p>Last sold at:</p>
                <p>{{ skin.price }}</p>
              </div>

              <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                <p>Current price range:</p>
                <p class="text-sm">120 - 500</p>
              </div>

              <div class="flex justify-between mt-2 text-white">
                <p>Sale order:</p>
                <p>64</p>
              </div>
            </div>

          </div>

          <div v-for="skin in listSkins" :key="skin.id"
            class="flex-shrink-0 p-1 bg-gray-900 border shadow-lg w-72 lg:w-80 rounded-xl min-w-80">
            <div class="py-14 p-1.5 rounded-lg bg-black border border-gray-700">
              <img class="object-contain h-28 w-96" :src="getImageUrl(skin.skin.image_path)"
                :alt="skin.skin.name">
            </div>

            <div class="px-6 py-4">
              <div class="mb-2 text-xl font-bold text-white">{{ skin.skin.name }}</div>

              <div class="flex pb-2 border-b border-gray-600">
                <p class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">
                  Mythic</p>

                <p class="text-white">
                  | Season 6
                </p>
              </div>

              <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                <p>Last sold at:</p>
                <p>{{ skin.price }}</p>
              </div>

              <div class="flex justify-between pb-2 mt-2 text-white border-b border-gray-600">
                <p>Current price range:</p>
                <p class="text-sm">120 - 500</p>
              </div>

              <div class="flex justify-between mt-2 text-white">
                <p>Sale order:</p>
                <p>64</p>
              </div>
            </div>

          </div>

        </div>
      </div>

    </section>
  </HomeLayout>
</template>
