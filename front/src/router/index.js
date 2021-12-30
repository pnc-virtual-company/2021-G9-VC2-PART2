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


Vue.use(VueRouter)

const routes = [
    { path: "/admin_view", component: Admin },
    // { path: "/ero_officers", component: EroOfficer },
    { path: "/alumni/profile/:name", component: AlumniProfileView },
    { path: "/alumni_users", component: Admin },
    { path: "/verify_email", component: VerifyEmail},
    { path: "/verify_password", component: VerifyPassword},
    { path: "/alumni_signup", component: AlumniSignup},
    { path: "/event", component: Event},
    { path: "/explore_alumni", component: ExploreAlumniView },

    { path: "/", redirect: "/verify_email" },



  
]

// let authenticationGuard = (to, from, next) => {
//   let needLogin = to.meta.needLogin;

//   if (needLogin) {
//     // let isLoggedIn = localStorage.getItem("userId") !== null;
//     if (!isLoggedIn) {
//       next("/login");
//     } else {
//       let needAdmin = to.meta.needAdmin;
//       if (needAdmin) {
//         // let isAdmin = localStorage.getItem("userRole") == "ADMIN";

//         if (isAdmin) {
//           next();
//         } else {
//           next("/unauthorized");
//         }
//       } else {
//         next();
//       }
//     }
//   } else {
//     next();
//   }
// };


const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

// router.beforeEach(authenticationGuard);


export default router
