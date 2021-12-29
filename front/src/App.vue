<template>
  <v-app>
    <navagation v-if="activeUser" @sign-out="userSignOut"></navagation>
    <v-main>
      <router-view
        @signin="userSignin"
        @verify-email="emailChecking"
        :userDataSignIn="userDataSignIn"
      />
    </v-main>
  </v-app>
</template>

<script>
import axios from "./api/api.js";
import Navagation from "./components/nav/Navigation.vue";

export default {
  name: "App",
  components: {
    Navagation,
  },
  data() {
    return {
      userDataSignIn: null,
      activeUser: null,
      alumnis: [],
      isLogin: false,
    };
  },
  watch: {
    activeUser() {
      return this.activeUser !== null;
    },
  },
  methods: {
    userSignin(user) {
      this.activeUser = user;
      localStorage.setItem("userId", user.id);
    },
    emailChecking(user) {
      this.userDataSignIn = user;
    },
    // userSignin(user){
    //   this.activeUser = user;
    //   localStorage.setItem("userID",JSON.stringify(user.id));
    // },
    userSignOut() {
      this.activeUser = null;
    },
  },
  mounted() {
    if (JSON.parse(localStorage.getItem("userID")) !== null) {
      axios.get("/users").then((res) => {
        let users = res.data;
        this.activeUser = users.filter(
          (user) => user.id === JSON.parse(localStorage.getItem("userID"))
        );
      });
    }
    let userData = JSON.parse(localStorage.getItem("user"));
    if (userData !== null) {
      this.activeUser = JSON.parse(localStorage.getItem("user"));
    } else {
      this.activeUser = userData;
    }
    this.activeUser = JSON.parse(localStorage.getItem("user"));
    // if(user !== null){
    //     this.activeUser = JSON.parse(localStorage.getItem("user"));}
    // else{
    //    this.activeUser = null;
    // }
  },
  provide(){
    return {activeUser : this.activeUser};
  }
};
</script>
