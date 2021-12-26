import Vue from 'vue'
import VueRouter from 'vue-router'
import AlumniProfileView from "./../components/views/alumniProfile/AlumniProfileView.vue";
import Example from "./../components/ui/Example.vue";

Vue.use(VueRouter)

const routes = [
  { path: "/profile", component: AlumniProfileView },
  { path: "/example", component: Example },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
