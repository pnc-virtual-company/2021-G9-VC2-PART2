import Vue from 'vue'
import VueRouter from 'vue-router'
// import EroOfficer from '../components/views/ero/EroView.vue'
import VerifyEmail from '../components/views/login/VerifyEmail.vue'
import VerifyPassword from '../components/views/login/VerifyPassword.vue'
import AlumniSignup from '../components/views/login/AlumniSignup.vue'
import AlumniProfileView from '../components/views/alumniProfile/AlumniProfileView.vue'
import Event from '../components/views/event/EventView.vue'
import Admin from '../components/views/admin/AdminView.vue'

import ExploreAlumniView from '../components/views/ero/ExploreAlumniView.vue'
// import axios from '../api/api.js'

Vue.use(VueRouter)

const routes = [
    { path: "/admin_view", component: Admin},
    // { path: "/ero_officers", component: EroOfficer },
    { path: "/alumni/profile/:name", component: AlumniProfileView},
    { path: "/alumni_users", component: Admin},
    { path: "/verify_email", component: VerifyEmail},
    { path: "/verify_password", component: VerifyPassword},
    { path: "/alumni_signup", component: AlumniSignup},
    { path: "/event", component: Event},
    { path: "/explore_alumni", component: ExploreAlumniView },
    { path: "/explore_alumni/alumni_profile/:name", component: AlumniProfileView },

    { path: "/", redirect: "/verify_email"},
]
const ENTER_EMAIL= 'enter_email';
const ENTER_PASSWORD= 'enter_password';
const ENTER_INFORMATION= 'enter_information';
const MAIN_PAGE= 'main_page';
let authenticationGuard = (to, from, next) => {
  let stepProcessing = localStorage.getItem('stepLogin');
  next()
  if(stepProcessing === ENTER_EMAIL){
    next()
  }else if (stepProcessing === ENTER_PASSWORD){
    next("/verify_password")
  }else if (stepProcessing === ENTER_INFORMATION){
    next("/alumni_signup")
  }else if (stepProcessing===MAIN_PAGE){
    let role = localStorage.getItem('role');
    if(role==="admin" || role === "ero"){
      let path = window.location.pathname;
      if((path !== "/admin_view" && path !== "/explore_alumni" && path !== "/event")){
        let id = localStorage.getItem("userId");
        next("/explore_alumni/alumni_profile/"+id)
      }
      else if(path !== "/admin_view" && path !== "/explore_alumni"){
        next("/event")
      }
      else if(path !== "/explore_alumni" && path !== "/event"){
        next("/admin_view")
      }
      else if(path !== "/event" && path !== "/admin_view"){
        next("/explore_alumni")
      }
      

    }else if (role === "alumni"){
      let name = localStorage.getItem("userName");
      let path = window.location.pathname;
      if(path !== "/alumni/profile/"+name){
        next("/event")
      }
      if(path !== "/event"){
        next("/alumni/profile/"+name)
      }
    }
  }
  else{
    next("/verify_email")
  }
}


const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach(authenticationGuard);


export default router
