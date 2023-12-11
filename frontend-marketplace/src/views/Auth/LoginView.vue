<script setup>
import http from "@/services/http.js";
import { reactive, ref } from "vue";
import { useAuthStore } from "@/stores/auth.js";
import router from "../../router";

const auth = useAuthStore();

let user = reactive({
    email: "",
    password: "",
});

let disabledButton = ref(false);

async function login() {
    try {
        disabledButton.value = true;
        const { data } = await http.post("/login", user);
        //console.log(data.data.token)
        if (data.message == "User Loged") {
            auth.setToken(data.data.token);
            auth.setUser(data.data.user_name);
            auth.setUserId(data.data.user_id)
            router.push({ name: "market" });
        }
    } catch (error) {
        disabledButton.value = false;
        console.log(error?.response?.data);
    }
}
</script>

<template>
    <div class="min-h-screen bg-black text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-black shadow sm:rounded-lg flex justify-center flex-1 text-white">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    <p class="text-center">Writer</p>
                </div>
                <div class="mt-12 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold">
                        Sign in
                    </h1>
                    <div class="w-full flex-1 mt-8">
                        <div class="mx-auto max-w-xs">
                            <form @submit.prevent="login" class="text-black">
                                <div>
                                    <input v-model="user.email" required autofocus autocomplete="username"
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="email" placeholder="Email or User" />
                                </div>

                                <div>
                                    <input v-model="user.password" required autocomplete="current-password"
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                        type="password" placeholder="••••••••" />
                                </div>

                                <button type="submit" :disabled="disabledButton"
                                    :class="[disabledButton ? 'bg-yellow-600' : 'bg-yellow-400 hover:bg-yellow-600']"
                                    class="mt-5 tracking-wide font-semibold text-white w-full py-4 rounded-lg transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="8.5" cy="7" r="4" />
                                        <path d="M20 8v6M23 11h-6" />
                                    </svg>
                                    <span class="ml-3">
                                        Sign In
                                    </span>
                                </button>
                                <p class="text-sm text-white font-light dark:text-gray-400">
                                    Don’t have an account yet? <router-link to="/register"
                                        class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign
                                        up</router-link>
                                </p>
                                <p class="mt-6 text-xs text-white text-center">
                                    I agree to abide by templatana's
                                    <a href="#" class="border-b border-gray-500 border-dotted">
                                        Terms of Service
                                    </a>
                                    and its
                                    <a href="#" class="border-b border-gray-500 border-dotted">
                                        Privacy Policy
                                    </a>
                                </p>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="flex-1 text-center hidden lg:flex bg-yellow-400">
                <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat" />
            </div>
        </div>
    </div>
</template>
