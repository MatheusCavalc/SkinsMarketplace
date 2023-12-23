import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import { useAuthStore } from '@/stores/auth.js';
import GuestHome from '../views/GuestHome.vue'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/Auth/LoginPage.vue'),
    meta: {
      unauthenticated: true
    }
  },
  {
    path: '/',
    name: 'Guest-Home',
    component: GuestHome,
    meta: {
      unauthenticated: true
    }
  },
  {
    path: '/market',
    name: 'market',
    component: () => import('@/views/Market/MarketPage.vue'),
    meta: {
      authenticated: true
    }
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: () => import('@/views/Market/CheckoutPage.vue'),
    meta: {
      authenticated: true
    }
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('@/views/Profile/ProfilePage.vue'),
    meta: {
      authenticated: true
    }
  } ,
  {
    path: '/profile/skins',
    name: 'profile-skins',
    component: () => import('@/views/Profile/UserSkins.vue'),
    meta: {
      authenticated: true
    }
  },
  {
    path: '/notifications',
    name: 'notifications',
    component: () => import('@/views/Profile/NotificationsPage.vue'),
    meta: {
      authenticated: true
    }
  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('@/views/Market/CartPage.vue'),
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

//Auth Guard
router.beforeEach(async (to, from, next) => {
  if (to.meta?.authenticated) {
    const auth = useAuthStore()
    if (auth.token && auth.user) {
      const isAuthenticated = await auth.checkToken();
      if (isAuthenticated == 'Valid Token') {
        next();
      } else {
        next({ name: 'login' });
      }
    } else {
      next({ name: 'login' })
    }
  }

  else if (to.meta?.unauthenticated) {
    const auth = useAuthStore()
    if (auth.token && auth.user) {
      next({ name: 'market' })
    } else {
      next()
    }
  }

  else {
    next()
  }
})

export default router
