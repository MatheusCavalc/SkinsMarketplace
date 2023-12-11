<script setup lang="ts">
import { IonContent, IonHeader, IonPage, IonTitle, IonToolbar } from '@ionic/vue';
</script>

<template>
  <ion-page>
    <section class="bg-slate-900 h-screen">
      <div class="grid grid-cols-1 content-center h-4/5">
        <p class="text-white text-center text-3xl font-bold">R6 Marketplace</p>

        <p class="text-white text-center text-sm">Buy and Sell your skins everywhere</p>
      </div>

      <div class="flex justify-center mx-5">
        <RouterLink to="/login" class="bg-blue-600 w-full text-center text-white font-bold p-4 rounded-md">
          Button
        </RouterLink>
      </div>
    </section>
  </ion-page>
</template>
