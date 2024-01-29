<script setup>
import { RouterLink } from 'vue-router';

</script>

<template>
    <section class="min-h-screen bg-image">
        <div class="gap-40 mx-5 lg:flex lg:justify-evenly">
            <div class="pt-20 lg:pt-44">
                <div class="">
                    <p class="text-4xl font-bold text-white lg:text-5xl">
                        Welcome to
                    </p>

                    <p class="mt-2 text-5xl font-bold text-white lg:text-7xl">
                        R6 Marketplace
                    </p>
                </div>

                <div class="mt-2 lg:mt-5">
                    <p class="text-lg text-gray-400 lg:text-xl">Sell, Buy or Trade your skins</p>
                </div>

                <div class="mt-2 lg:mt-5">
                    <RouterLink to="/market">
                        <button type="button"
                            class="py-2.5 px-5 me-2 mb-2 text-base lg:text-lg font-medium text-gray-900 focus:outline-none bg-white hover:bg-black rounded-full border border-gray-200 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-200">Market</button>
                    </RouterLink>
                </div>
            </div>

            <div class="pt-28">
                <div>
                    <img class="w-72 lg:w-[420px] rotate-12 drop-shadow-2xl" src="../assets/gun-item.jpg" alt="">

                    <div class="mt-2 text-right lg:text-left">
                        <p class="text-sm text-white">C7E</p>
                        <p class="text-lg text-white">Archea Metalica</p>
                    </div>
                </div>

                <div>
                    <img class="w-96 lg:w-[450px] -rotate-12" src="../assets/home-skin-2.png" alt="">

                    <div class="text-right">
                        <p class="text-sm text-white">C8</p>
                        <p class="text-lg text-white">Black Ice</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.bg-image {
    background-size: cover;
    background-position: center;
    width: 100%;
    background-image: url('https://static-dm.ubisoft.com/siege/prod/be4392693c89991e67abe51d6250277e.jpg');
    background-repeat: no-repeat;
}
</style>