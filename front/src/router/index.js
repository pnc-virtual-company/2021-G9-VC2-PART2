import Vue from 'vue'
import VueRouter from 'vue-router'
// import View from './../components/views/Example.vue'
import Admin from '../components/admin/Admin.vue'
import AlumniProfileView from '../components/views/alumniProfile/AlumniProfileView.vue'
import ExploreAlumniView from '../components/views/ero/ExploreAlumniView.vue'


Vue.use(VueRouter)

const routes = [
    { path: "/admin", component: Admin },
    { path: "/ero_officers", component: Admin },
    { path: "/alumni_profile", component: Admin },
    { path: "/alumni_users", component: Admin },
    { path: "/alumni/profile", component: AlumniProfileView },
    { path: "/explore_alumni", component: ExploreAlumniView },

    // { path: "/", redirect: "/signin" },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
