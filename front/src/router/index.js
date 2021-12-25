import Vue from 'vue'
import VueRouter from 'vue-router'
//IMPORT COMPONENTS
import SignUpStepOne from '../components/authentication/SignUpStepOne'
import SignUpStepTwo from '../components/authentication/SignUpStepTwo'
import SignIn from '../components/authentication/SignIn'

Vue.use(VueRouter)

const routes = [
  {path: '/signup-one',component: SignUpStepOne},
  {path: '/signup-two',component: SignUpStepTwo},
  {path: '/',component: SignIn},

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
