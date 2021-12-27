
<template>
  <div
    class="d-flex justify-center align-center flex-column"
    style="height: 100vh"
  >
    <v-card
      width="65%"
      color="#22BBEA"
      elevation="15"
      class="main-container pa-3 d-flex justify-center align-center"
    >
      <v-row class="sub-container">
        <v-col cols="12" xs="12" sm="10" md="6" lg="6">
          <v-card color="transparent" elevation="0" class="pa-5">
            <h1 class="text-center white--text mb-3">Sign in</h1>

            <v-row no-gutters>
              <v-col cols="12">
                <v-text-field
                  dense
                  class="mr-1 mt-4"
                  background-color="white"
                  placeholder="Password"
                  :rules="passwordRules"
                  outlined
                  :type="showPassword ? 'text' : 'password'"
                  v-model="password"
                ></v-text-field>
              </v-col>
            </v-row>
            
            <v-checkbox
              class="ma-0 pa-0"
              v-model="showPassword"
              :label="showPassword ? 'Hide password' : 'Show password'"    
            ></v-checkbox>
            <v-row>
              <v-col cols="12">
                <v-card
                  dense
                  class="d-flex justify-center"
                  color="transparent"
                  elevation="0"
                >
                  
                <v-btn color="#FF9933" class="white--text" @click="verifyPassword">NEXT</v-btn>
                </v-card>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
        <v-col
          cols="12"
          lg="6"
          md="6"
          sm="12"
          xs="12"
          class="white d-flex justify-center align-center"
        >
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
import axios from "../../../api/api.js"

export default {
  props:['userDataSignIn'],
  emits: ['signin'],
  data() {
    return {
      passwordRules: [
        (v) => !!v || "E-mail is required",
        (v) => (v && v.length >= 8) || "Confirm Password at leaste 8 characters",
      ],
      password: "",
      showPassword: false,
    };
  },
  watch: {
    password(){
      this.passwordRules = [
        (v) => !!v || "E-mail is required",
        (v) => (v && v.length >= 8) || "Confirm Password at leaste 8 characters",
      ]
    }
  },
  methods:{
    verifyPassword(){
      let user = { 
        email: JSON.parse(localStorage.getItem('user')).email,
        password: this.password
      };
      axios.post("/signin", user)
      .then((res)=>{
        if(res.data.user.role === 'admin'){
          this.$router.push("/admin_view").catch(()=>{});
        }else if(res.data.user.role === 'alumni'){
          this.$router.push("/alumni/profile/"+res.data.user.first_name).catch(()=>{});
        }else{
          
          this.$router.push("/ero_officers").catch(()=>{});
        }
        this.$emit('signin', res.data.user);
      })
      .catch(()=>{
        this.passwordRules = ['Your Password does not exist']
      })
      
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
  .sub-container {
    display: flex;
    flex-direction: column-reverse;
    justify-content: center;
    align-items: center;
  }
}
@media screen and (min-width: 300px) and (max-width: 500px) {
  .alumni-logo {
    width: 100px;
  }
}
</style>