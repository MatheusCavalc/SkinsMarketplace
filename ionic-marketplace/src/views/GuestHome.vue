<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
</script>

<template>
  <ion-page>
    <section class="h-screen bg-slate-900 bg-home">
      <div class="grid content-center grid-cols-1 h-4/5">
        <p class="text-3xl font-bold text-center text-white">R6 Marketplace</p>

        <p class="text-sm text-center text-white">Buy and Sell your skins everywhere</p>
      </div>

      <div class="flex justify-center mx-5">
        <RouterLink to="/login" class="w-full p-4 font-bold text-center text-black bg-white border rounded-xl">
          Sign In
        </RouterLink>
      </div>
    </section>
  </ion-page>
</template>

<style scoped>
.bg-home {
    background-size: cover;
    background-position: center;
    width: 100%;
    background-image: linear-gradient(#000000bb, #000000bb), url('https://cdn-0.r6siegecenter.com/wp-content/uploads/2023/09/vigil-trailer3-min-1024x549.jpg');
    background-repeat: no-repeat;
}
</style>