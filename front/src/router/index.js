import Vue from 'vue'
import VueRouter from 'vue-router'
// import View from './../components/views/Example.vue'
import Admin from '../components/views/admin/Admin.vue'
import EroOfficer from '../components/views/ero/View.vue'
import VerifyEmail from '../components/authentication/VerifyEmail.vue'
import VerifyPassword from '../components/authentication/VerifyPassword.vue'
import AlumniSignup from '../components/authentication/AlumniSignup.vue'
import AlumniProfileView from '../components/views/alumniProfile/AlumniProfileView.vue'
// import AlumniProfileView from '../components/views/alumniProfile/AlumniProfileView.vue'


Vue.use(VueRouter)

const routes = [
    { path: "/admin", component: Admin },
    { path: "/ero_officers", component: EroOfficer },
    // { path: "/alumni_profile", component: Admin },
    { path: "/alumni/profile/:name", component: AlumniProfileView },
    { path: "/alumni_users", component: Admin },
    { path: "/verify-email", component: VerifyEmail },
    { path: "/verify-password", component: VerifyPassword },
    { path: "/alumni-signup", component: AlumniSignup },
    // { path: "/alumni/profile", component: ProfileAlumniView },

    { path: "/", redirect: "/verify-email" },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
