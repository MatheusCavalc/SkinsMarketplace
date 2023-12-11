<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useCartStore } from '@/stores/cart';
import { useFunctionsStore } from '@/stores/functions';
import http from "@/services/http";
import router from '../router';

const cartInfos = useCartStore()
const functions = useFunctionsStore()

const emits = defineEmits(['checkoutInit'])

const disabledButton = ref(false)

const skinsIds = reactive({
    ids: cartInfos.cartIds
})

async function checkout() {
    try {
        disabledButton.value = true        
        const { data } = await http.post("/checkout", skinsIds);

        if (data.message == "Confirm Buy") {
            emits('checkoutInit')
            cartInfos.clearCart()
            functions.openToast()
            router.push({ name: "market" });
        }
    } catch (error: any) {
        disabledButton.value = false;
        console.log(error?.response?.data);
    }
}
</script>

<template>
    <button @click="checkout" :disabled="disabledButton" class="w-full p-4 text-center bg-blue-700 cursor-pointer rounded-xl">
        <p>Proceed to Buy</p>
    </button>
</template>