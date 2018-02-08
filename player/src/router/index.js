import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Partie from '@/components/Partie'
import Historique from '@/components/Historique'

Vue.use(Router)

export default new Router({
  routes: [
    {
	    path: '/',
	    name: 'index',
      pathname: 'index',
	    component: Index
    },
    {
    	path: '/historique',
    	name: 'historique',
      pathname: 'historique',
    	component: Historique
    },
    {
      path: '/partie/:id',
      name : 'partie',
      pathname: 'partie',
      component : Partie
    }
  ]
})
