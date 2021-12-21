import Vue from 'vue'
import VueRouter from 'vue-router'
import View from './../components/views/Example.vue'
import Admin from '../components/admin/Admin'
Vue.use(VueRouter)

const routes = [
    { path: "/admin", component: Admin },
    { path: "/ero_officers", component: View },
    { path: "/alumni_profile", component: View },
    { path: "/alumni_users", component: View },
    // { path: "/alumnis", component: AlumniView },
    // { path: "/alumni/profile", component: ProfileAlumniView },

    { path: "/", redirect: "/admin" },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
