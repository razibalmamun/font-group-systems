import { createRouter, createWebHistory } from 'vue-router'
import FontList from '../views/Font/FontList.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'font-list',
      component: FontList
    },
    {
      path: '/fonts/create',
      name: 'font-create',
      component: () => import('../views/Font/FontAdd.vue')
    },
    {
      path: '/groups',
      name: 'group',
      component: () => import('../views/Group/GroupView.vue')
    },
    {
      path: '/groups/create',
      name: 'group-create',
      component: () => import('../views/Group/GroupAdd.vue')
    },
    {
      path: '/groups/:id',
      name: 'group-edit',
      component: () => import('../views/Group/GroupEdit.vue')
    }
  ]
})

export default router
