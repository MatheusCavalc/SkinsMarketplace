<script setup>
import { RouterLink } from 'vue-router';

</script>

<template>
    <section class="bg-image h-screen">
        <div class="lg:flex lg:justify-evenly gap-40 mx-5">
            <div class="pt-44">
                <div class="">
                    <p class="font-bold text-white text-3xl lg:text-5xl">
                        Welcome to
                    </p>

                    <p class="font-bold text-white text-5xl lg:text-7xl mt-2">
                        R6 Marketplace
                    </p>
                </div>

                <div class="mt-2 lg:mt-5">
                    <p class="text-lg lg:text-xl text-gray-400">Sell, Buy or Trade your skins</p>
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
                    <img class="w-[420px] rotate-12 drop-shadow-2xl" src="../assets/gun-item.jpg" alt="">

                    <div class="mt-2 text-right lg:text-left">
                        <p class="text-white text-sm">C7E</p>
                        <p class="text-white text-lg">Archea Metalica</p>
                    </div>
                </div>

                <div>
                    <img class="w-[450px] -rotate-12" src="../assets/home-skin-2.png" alt="">

                    <div class="">
                        <p class="text-white text-sm">C8</p>
                        <p class="text-white text-lg">Black Ice</p>
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