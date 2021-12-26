import Vue from 'vue'
import VueRouter from 'vue-router'
import Admin from '../components/views/admin/AdminView.vue'
import EroOfficer from '../components/views/ero/EroView.vue'
import VerifyEmail from '../components/views/login/VerifyEmail.vue'
import VerifyPassword from '../components/views/login/VerifyPassword.vue'
import AlumniSignup from '../components/views/login/AlumniSignup.vue'
import AlumniProfileView from '../components/views/alumni/AlumniProfileView.vue'
Vue.use(VueRouter)

const routes = [
    { path: "/admin_view", component: Admin },
    { path: "/ero_officers", component: EroOfficer },
    { path: "/alumni/profile/:name", component: AlumniProfileView },
    { path: "/alumni_users", component: Admin },
    { path: "/verify_email", component: VerifyEmail },
    { path: "/verify_password", component: VerifyPassword },
    { path: "/alumni_signup", component: AlumniSignup },
    { path: "/", redirect: "/verify_email" },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
