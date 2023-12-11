<script setup lang="ts">
import { useFunctionsStore } from '../stores/functions';

const modal = useFunctionsStore()
</script>

<template>
    <div class="flex w-full max-w-xs px-4 py-2 space-x-1 text-white bg-black rounded-lg shadow-xl space-x">

        <div class="pl-1 text-white">
            <p class="text-sm font-bold mb-0.5">Purchase in processing!</p>
            <p class="text-sm">Check your notifications or email for confirmation</p>
        </div>

        <button @click="modal.closeToast()" class="flex justify-end w-6 h-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</template>