<script setup lang="ts"> 
import { useAuthStore } from '../stores/auth'

const auth = useAuthStore()
</script>

<template>
    <div>
        <p class="text-sm">{{ auth.userCredits }}</p>
    </div>
</template>