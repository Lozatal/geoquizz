import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Partie from '@/components/Partie'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/parties/',
      name : 'Partie',
      component : Partie
    }
  ]
})
