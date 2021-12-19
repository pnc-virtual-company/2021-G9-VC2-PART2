import Vue from 'vue'
import VueRouter from 'vue-router'
import View from './../components/views/Example.vue'
Vue.use(VueRouter)

const routes = [
    { path: "/admin", component: View },
    { path: "/ero_officers", component: View },
    { path: "/alumni_profile", component: View },
    { path: "/alumni_users", component: View },
    // { path: "/alumnis", component: AlumniView },
    // { path: "/alumni/profile", component: ProfileAlumniView },

    { path: "/", redirect: "/alumnis" },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
