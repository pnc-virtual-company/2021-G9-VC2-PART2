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
    userSignin(user,token) {
      this.activeUser = user;
      localStorage.setItem("token",token);
      localStorage.setItem("userId", user.id);
    },
    emailChecking(user) {
      this.userDataSignIn = user;
    },
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
    let userData = JSON.parse(localStorage.getItem("userId"));
    if (userData !== null) {
      this.activeUser = JSON.parse(localStorage.getItem("userId"));
    } else {
      this.activeUser = userData;
    }
    this.activeUser = JSON.parse(localStorage.getItem("userId"));
  },
  
};
</script>
