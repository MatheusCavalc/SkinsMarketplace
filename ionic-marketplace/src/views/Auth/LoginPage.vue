<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
import { onIonViewWillEnter, onIonViewDidEnter, onIonViewWillLeave, onIonViewDidLeave } from '@ionic/vue';
import { useAuthStore } from '@/stores/auth'
import http from '@/services/http'
import { reactive, ref } from 'vue'
import router from '@/router'
import { useBackButton, useIonRouter } from '@ionic/vue';
import { App } from '@capacitor/app';

const auth = useAuthStore();

interface User {
    email: string;
    password: string;
}

const user = reactive<User>({
    email: "",
    password: "",
});

let disabledButton = ref<boolean>(false);

interface ApiResponse {
    message: string;
    data: {
        token: string;
        user_name: string;
        user_id: string;
        user_credits: string
    };
}

async function login() {
    try {
        const { data } = await http.post<ApiResponse>("/login", user);
        if (data.message == "User Loged") {
            disabledButton.value = true;
            auth.setToken(data.data.token);
            auth.setUser(data.data.user_name);
            auth.setUserId(data.data.user_id)
            auth.setUserCredits(data.data.user_credits)
            router.push({ name: "market" });
        }
    } catch (error: any) {
        disabledButton.value = false;
        console.log(error?.response?.data);
    }
}

onIonViewWillEnter(() => {
    disabledButton.value = false;
})

const ionRouter = useIonRouter();
useBackButton(-1, () => {
    if (!ionRouter.canGoBack()) {
        App.exitApp();
    }
});
</script>

<template>
    <ion-page>
        <div class="flex justify-center min-h-screen text-gray-900 bg-black">
            <div class="flex justify-center flex-1 max-w-screen-xl m-0 text-white bg-black shadow sm:m-10 sm:rounded-lg">
                <div class="p-6 lg:w-1/2 xl:w-5/12 sm:p-12">
                    <div class="flex flex-col items-center mt-12">
                        <h1 class="text-2xl font-extrabold xl:text-3xl">
                            Sign in
                        </h1>
                        <div class="flex-1 w-full mt-8">
                            <div class="max-w-xs mx-auto">
                                <form @submit.prevent="login" class="text-black">
                                    <div>
                                        <input v-model="user.email" required autofocus autocomplete="username"
                                            class="w-full px-8 py-4 text-sm font-medium placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400 focus:bg-white"
                                            type="email" placeholder="Email or User" />
                                    </div>

                                    <div>
                                        <input v-model="user.password" required autocomplete="current-password"
                                            class="w-full px-8 py-4 mt-5 text-sm font-medium placeholder-gray-500 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-400 focus:bg-white"
                                            type="password" placeholder="••••••••" />
                                    </div>

                                    <button type="submit" :disabled="disabledButton"
                                        :class="[disabledButton ? 'bg-blue-300' : 'bg-blue-600 hover:bg-blue-800']"
                                        class="w-full py-4 mt-5 font-semibold tracking-wide text-white transition-all duration-300 ease-in-out rounded-lg focus:shadow-outline focus:outline-none">
                                        <p v-if="!disabledButton" class="flex items-center justify-center">
                                            <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                                <circle cx="8.5" cy="7" r="4" />
                                                <path d="M20 8v6M23 11h-6" />
                                            </svg>
                                            <span class="ml-3">
                                                Sign In
                                            </span>
                                        </p>

                                        <p v-else class="flex items-center justify-center">
                                            <svg aria-hidden="true"
                                                class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                        </p>
                                    </button>
                                    <p class="mt-6 text-xs text-center text-white">
                                        I agree to abide by marketplace
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
                <div class="flex-1 hidden text-center lg:flex bg-slate-900">
                    <div class="w-full m-12 bg-center bg-no-repeat bg-contain xl:m-16" />
                </div>
            </div>
        </div>
    </ion-page>
</template>
