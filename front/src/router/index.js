import Vue from 'vue'
import VueRouter from 'vue-router'
// import View from './../components/views/Example.vue'
import Admin from '../components/admin/Admin.vue'
import SignIn from '../components/authentication/SignIn.vue'
import SignupOne from '../components/authentication/SignUpStepOne.vue'
import SignupTwo from '../components/authentication/SignUpStepTwo.vue'
import AlumniProfileView from '../components/views/alumniProfile/AlumniProfileView.vue'


Vue.use(VueRouter)

const routes = [
    { path: "/admin", component: Admin },
    { path: "/ero_officers", component: Admin },
    { path: "/alumni_profile", component: Admin },
    { path: "/alumni_users", component: Admin },
    { path: "/signin", component: SignIn },
    { path: "/signup-one", component: SignupOne },
    { path: "/signup-two", component: SignupTwo },
    { path: "/alumni/profile", component: AlumniProfileView },
    // { path: "/alumni/profile", component: ProfileAlumniView },

    { path: "/", redirect: "/signin" },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
