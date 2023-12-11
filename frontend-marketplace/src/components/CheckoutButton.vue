<script setup>
import { reactive } from 'vue';
import { useCartStore } from '../stores/cart';
import { useFunctionsStore } from '../stores/functions';
import http from "@/services/http.js";
import router from '../router';

const cartInfos = useCartStore()
const functions = useFunctionsStore()

const emits = defineEmits(['checkoutInit'])

const skinsIds = reactive({
    ids: cartInfos.cartIds
})

async function checkout() {
    try {
        const { data } = await http.post("/checkout", skinsIds);
        
        if (data.message == "Confirm Buy") {
        emits('checkoutInit')
        cartInfos.clearCart()
        functions.openToast()
        router.push({ name: "market" });
        }
    } catch (error) {
        disabledButton.value = false;
        console.log(error?.response?.data);
    }
}
</script>

<template>
    <div @click="checkout" class="bg-blue-700 mt-4 cursor-pointer text-center rounded-xl p-2 m-4">
        <p>Proceed to Buy</p>
    </div>
</template>