import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import http from '@/services/http.ts'
import router from '@/router'

export const useAuthStore = defineStore('auth', () => {
  const token = ref(localStorage.getItem('token'))
  const user = ref(localStorage.getItem('user'))
  const userId = ref(localStorage.getItem('user_id'))
  const userCredits = ref(localStorage.getItem('user_credits'))

  function setToken(tokenValue: string | null): void {
    localStorage.setItem('token', tokenValue || '');
    token.value = tokenValue;
  }

  function setUser(userValue: string | null): void {
    localStorage.setItem('user', userValue || '');
    user.value = userValue;
  }

  function setUserId(userIdValue: string | null): void {
    localStorage.setItem('user_id', userIdValue || '');
    userId.value = userIdValue;
  }

  function setUserCredits(userCreditsValue: string | null): void {
    localStorage.setItem('user_credits', userCreditsValue || '');
    userCredits.value = userCreditsValue;
  }

  const isAuthenticated = computed(() => {
    return user.value && token.value
  })

  async function clear(): Promise<void> {
    try {
      const tokenAuth = 'Bearer ' + token.value
      const { data } = await http.post('/logout', {
        headers: {
          Authorization: tokenAuth
        }
      });
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      token.value = ''
      user.value = ''
    } catch (error: any) {
      console.log(error.response.data)
    }
    router.push({ name: 'Guest-Home' })
  }

  async function checkToken(): Promise<string | undefined> {
    try {
      const tokenAuth = 'Bearer ' + token.value
      const { data } = await http.get('/verify-token', {
        headers: {
          Authorization: tokenAuth
        }
      });
      return data.message;
    } catch (error: any) {
      console.log(error.response.data)
    }
  }

  return {
    token,
    user,
    userId,
    userCredits,
    setToken,
    setUser,
    setUserId,
    setUserCredits,
    checkToken,
    isAuthenticated,
    clear
  }
})
