<template>
  <v-app>
    <navagation v-if="activeUser" @sign-out="userSignOut"></navagation>
    <v-main>
      <router-view @signin="userSignin"/>
    </v-main>
  </v-app>
</template>

<script>
import Navagation from "./components/nav/Navigation.vue";


export default {
  name: 'App',
  components: {
    Navagation
  },
  data(){
    return{
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
    userSignin(user){
      this.activeUser = user;
      // let alumni = this.alumnis.filter(alumni => alumni.user_id === this.userId);
      // let user = JSON.parse(localStorage.getItem('user'));
      // if (user.role === 'alumni'){
      //   let userData = {
      //     first_name: user.first_name,
      //     last_name: user.last_name,
      //     phone_number: alumni[0].phone_number,
      //     gender: alumni[0].gender,
      //     id: user.id,
      //     email: user.email,
      //     role: 'alumni'
      //   }
      //   localStorage.setItem('user', JSON.stringify(userData));
      // }
      localStorage.setItem('user',JSON.stringify(user));
      // console.log(this.activeUser);
    },
    userSignOut(){
        this.activeUser = null;
      }
  },
  mounted(){
    if ((window.localStorage.getItem("user") !== null) && this.$route.path == "/signIn" ) {
      this.activeUser = JSON.parse(localStorage.getItem("user"));
    }
    let user = JSON.parse(localStorage.getItem("user"));
    if(user !== null){
        this.activeUser = JSON.parse(localStorage.getItem("user"));

    }
    else{
       this.activeUser = user;
      //  this.$router.push('/signin').catch(()=>{});

    }
    // axios.get('/alumnis').then((res)=>{
    //   this.alumni = res.data.data;
    // });
    // window.onpopstate = () => {
      // if ((window.localStorage.getItem("user") !== null) && this.$route.path == "/signIn" || this.$route.path == "/") {
          // this.$router.push("/myEvent"); // redirect to myEvent, for example
      // }
      // console.log(event);
    // };
  }
};
</script>
