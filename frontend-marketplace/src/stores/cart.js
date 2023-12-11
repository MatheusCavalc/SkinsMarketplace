import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useCartStore = defineStore('cart', () => {

  const items = ref([])

  const cartItems = computed(() => {
    return items.value
  })

  const cartTotal = computed(() => {
    return items.value.reduce((total, item) => total + parseFloat(item.price), 0).toFixed(2);
  });

  const cartIds = ref([])

  function addToCart(item) {
    const isItemInCart = cartIds.value.includes(item.id);

    const user_id = localStorage.getItem('user_id')
    if (!isItemInCart && item.user_id != user_id) {
      items.value.push(item);
      cartIds.value.push(item.id);
    }
  }

  function removeFromCart(product) {
    const index = items.value.findIndex((item) => item.id === product.id);
    if (index !== -1) {
      items.value.splice(index, 1);
    }

    const cartIdIndex = cartIds.value.indexOf(product.id);
    if (cartIdIndex !== -1) {
      cartIds.value.splice(cartIdIndex, 1);
    }

  }

  function clearCart() {
    items.value = []
    cartIds.value = []
  }

  return {
    items,
    cartItems,
    cartTotal,
    cartIds,
    addToCart,
    removeFromCart,
    clearCart,
  }
})