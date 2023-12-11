import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

interface CartItem {
  id: number;
  name: string;
  price: string;
  user_id: string;
}

export const useCartStore = defineStore('cart', () => {

  const items = ref<CartItem[]>([])

  const cartItems = computed(() => {
    return items.value
  })

  const cartTotal = computed(() => {
    return items.value.reduce((total: any, item: CartItem) => total + parseFloat(item.price), 0).toFixed(2);
  });

  const cartIds = ref<number[]>([])

  function addToCart(item: CartItem): void {
    const isItemInCart = cartIds.value.includes(item.id);

    const user_id = localStorage.getItem('user_id')
    if (!isItemInCart && item.user_id != user_id) {
      items.value.push(item);
      cartIds.value.push(item.id);
    }
  }

  function removeFromCart(product: CartItem): void {
    const index = items.value.findIndex((item) => item.id === product.id);
    if (index !== -1) {
      items.value.splice(index, 1);
    }

    const cartIdIndex = cartIds.value.indexOf(product.id);
    if (cartIdIndex !== -1) {
      cartIds.value.splice(cartIdIndex, 1);
    }

  }

  function clearCart(): void {
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