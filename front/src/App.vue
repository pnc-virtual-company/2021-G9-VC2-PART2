<template>
  <v-app>
    <navagation v-if="activeUser" @sign-out="userSignOut" :activeUser="activeUser"></navagation>
    <v-main>
      <router-view @signin="userSignin" @verify-email="emailChecking" :userDataSignIn="userDataSignIn"/>
    </v-main>
  </v-app>
</template>

<script>

import axios from "./api/api.js"
import Navagation from "./components/nav/Navigation.vue";

export default {
  name: 'App',
  components: {
    Navagation
  },
  data(){
    return{
        userDataSignIn:null,
        activeUser:null,
        alumnis: [],
        isLogin: false,
    }
  },
  watch : {
    activeUser(){
      return this.activeUser !== null;
    }
  },
  methods: {
    emailChecking(user){
      this.userDataSignIn = user;
    },
    userSignin(user){
      this.activeUser = user;
      localStorage.setItem("userID",JSON.stringify(user.id));
    },
    userSignOut(){
        this.activeUser = null;
      }
  },
  
  mounted(){
    if(JSON.parse(localStorage.getItem("userID")) !==null){
        axios.get('/users').then((res)=>{
        let users = res.data;
        this.activeUser = users.filter(user => user.id === JSON.parse(localStorage.getItem("userID")));
    });
    }
  },
};
</script>
