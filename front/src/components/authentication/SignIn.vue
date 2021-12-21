
<template>
  <div
    class="d-flex justify-center align-center flex-column"
    style="height: 100vh"
  >
    <v-card width="65%" color="#22BBEA" elevation="15" class="main-container pa-3 d-flex justify-center align-center">
      <v-row class="sub-container">
        <v-col cols="12" xs="12" sm="10" md="6" lg="6">
          <v-card color="transparent" elevation="0" class="pa-5">
          <h1 class="text-center white--text">SIGN IN</h1>
          
          <v-row no-gutters>
            <v-col cols="12">
              <v-text-field
                dense
                placeholder="E-mail"
                :rules = "emailRules"
                type="email"
                outlined
                background-color="white"
                v-model="email"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row no-gutters>
            <v-col cols="12">
              <v-text-field
                :rules ="passwordRules"
                dense
                placeholder="Password"
                type="password"
                outlined
                background-color="white"
                v-model="password"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row no-gutters>
            <v-col cols="12">
              <router-link class="purple--text text-decoration-underline" to="/signup-one">Create an account</router-link>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <v-card
                dense
                class="d-flex justify-center"
                color="transparent"
                elevation="0"
              >
                <v-btn color="#FF9933" class="white--text" @click="isSignIn">NEXT</v-btn>
              </v-card>
            </v-col>
          </v-row>
           </v-card>
        </v-col>
        <v-col cols="12" lg="6" md="6" sm="12" xs="12" class="white d-flex justify-center align-center">
          <v-img
            src="https://www.passerellesnumeriques.org/wp-content/uploads/2019/03/PN-Cambodia-Alumni-Association.png"
            max-height="200"
            max-width="250px"
            min-width="10px"
            class="alumni-logo"
          ></v-img>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>

<script>
import axios from "./../../api/api.js"
export default {
  emits:['signin'],
  data() {
    return {
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
      ],
      passwordRules: [
        (v) => !!v || "Password is required",
        (v) => (v && v.length >= 8) || "Min length should be 8",
      ],

      email: '',
      password: '',
      usersData: [],
      user: {}
    };
  },
  methods: {
    isSignIn(){
      // this.usersData.filter(user => user.email === this.email && user.password === this.password);
      let user = {
        email: this.email,
        password: this.password
      }
      axios.post('/signin', user).then((res)=>{
        this.user = res.data.user;
        if(this.user.first_name !== null && this.user.last_name !== null){
          if(this.user.role === 'admin'){
            this.$router.push('/admin');       
          }else if(this.user.role === 'alumni'){
            this.$router.push('/alumni/profile');
          }
          this.$emit('signin', this.user);
        }
        
        // localStorage.setItem('user', JSON.stringify(this.user));
      }).catch((error)=> console.log(error))
    }
  },
  mounted(){

  }
};
</script>

<style scoped>
a {
  text-decoration: none;
}
@media screen and (min-width: 300px) and (max-width: 960px) {
  .sub-container{
    display: flex;
    flex-direction: column-reverse;
    justify-content: center;
    align-items: center;
  }

}
@media screen and (min-width: 300px) and (max-width: 500px){
  .alumni-logo{
   width: 100px;
  }

}
</style>