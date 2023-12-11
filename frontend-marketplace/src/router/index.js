import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth.js';
import LoginView from '../views/Auth/LoginView.vue';
import HomeView from '../views/HomeView.vue'
import MarketIndex from '../views/Market/MarketIndex.vue';
import UserInfos from '../views/Profile/UserInfos.vue';
import UserSkins from '../views/Profile/UserSkins.vue';
import UserSale from '../views/Profile/UserSale.vue'
import UserBuy from '../views/Profile/UserBuy.vue'
import CheckoutView from '../views/Market/CheckoutView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: {
        unauthenticated: true
      }
    },
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        unauthenticated: true
      }
    },
    {
      path: '/market',
      name: 'market',
      component: MarketIndex,
      meta: {
        authenticated: true
      }
    },
    {
      path: '/profile',
      name: 'profile',
      component: UserInfos,
      meta: {
        authenticated: true
      }
    },

    {
      path: '/checkout',
      name: 'checkout',
      component: CheckoutView,
      meta: {
        authenticated: true
      }
    },

    {
      path: '/profile/skins',
      name: 'profile-skins',
      component: UserSkins,
      meta: {
        authenticated: true
      }
    },
    {
      path: '/profile/sale',
      name: 'profile-sale',
      component: UserSale,
      meta: {
        authenticated: true
      }
    },
    {
      path: '/profile/buy',
      name: 'profile-buy',
      component: UserBuy,
      meta: {
        authenticated: true
      }
    },
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta?.authenticated) {
    const auth = useAuthStore()
    if (auth.token && auth.user) {
      const isAuthenticated = await auth.checkToken();
      //console.log(isAuthenticated);
      if (isAuthenticated == 'Valid Token') {
        next();
      } else {
        next({ name: 'login' });
      }
    } else {
      next({ name: 'login' })
    }
    //console.log(to.name)
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
