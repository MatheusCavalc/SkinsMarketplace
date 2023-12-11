import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useFunctionsStore = defineStore('functions', () => {

  const toast = ref(false)

  function openToast() {
    setTimeout(() => toast.value = true, 700)
  }

  function closeToast() {
    toast.value = false
  }

  return {
    toast,
    openToast,
    closeToast,
  }
})