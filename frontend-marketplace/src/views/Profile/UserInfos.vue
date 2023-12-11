<script setup>
import HomeLayout from '../../layouts/HomeLayout.vue'
</script>

<template>
    <HomeLayout>
        <section class="h-screen px-10 py-10 text-white bg-slate-900">
            <div>
                <p class="text-3xl font-bold">My Profile</p>
            </div>

            <div class="lg:w-1/5 lg:mx-20 mt-20">
                <RouterLink to="/profile/skins" class="flex justify-between pb-3 border-b">
                    <div>
                        <p class="text-xl">
                            Skins
                        </p>
                    </div>
                    <div>
                        <p class="text-xl">
                            >
                        </p>
                    </div>
                </RouterLink>

                <RouterLink to="/profile/buy" class="flex justify-between pb-3 mt-3 border-b">
                    <div>
                        <p class="text-xl">
                            Buys
                        </p>
                    </div>
                    <div>
                        <p class="text-xl">
                            >
                        </p>
                    </div>
                </RouterLink>

                <RouterLink to="/profile/sale" class="flex justify-between pb-3 mt-3 border-b">
                    <div>
                        <p class="text-xl">
                            Sells
                        </p>
                    </div>
                    <div>
                        <p class="text-xl">
                            >
                        </p>
                    </div>
                </RouterLink>

                <div class="flex justify-between pb-3 mt-3 border-b">
                    <div>
                        <p class="text-xl">
                            Account
                        </p>
                    </div>
                    <div>
                        <p class="text-xl">
                            >
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>

<style scoped>
.bg-home {
    background-size: cover;
    background-position: center;
    width: 100%;
    background-image: linear-gradient(#000000bb, #000000bb), url('../assets/images/bg-image.webp');
    background-repeat: no-repeat;
}
</style>