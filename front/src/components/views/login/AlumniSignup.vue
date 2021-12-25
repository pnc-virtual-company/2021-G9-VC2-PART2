
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
            <h1 class="text-center white--text mb-3">SIGN UP</h1>
            <v-row no-gutters>
              <v-col cols="12" lg="6" md="6" sm="6" xs="12">
                <v-text-field
                  dense
                  placeholder="First name"
                  :rules="nameRules"
                  type="text"
                  outlined
                  background-color="white"
                  class="mr-1"
                  v-model="first_name"
                ></v-text-field>
              </v-col>
              <v-col cols="12" lg="6" md="6" sm="6" xs="12">
                <v-text-field
                  :rules="nameRules"
                  dense
                  class="mr-1"
                  placeholder="Last name"
                  type="text"
                  outlined
                  background-color="white"
                  v-model="last_name"
                ></v-text-field>
              </v-col>
            </v-row>
            
            <v-row no-gutters>
              <v-col cols="12">
                <v-text-field
                  dense
                  class="mr-1"
                  :rules="phoneRules"
                  background-color="white"
                  placeholder="Phone number"
                  outlined
                  v-model="phone_number"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row no-gutters hide-details>
              <v-col cols="12" lg="6" md="6" sm="6" xs="12">
                <v-text-field
                  :type="isShowPassword ? 'text' : 'password'"
                  dense
                  placeholder="Password"
                  v-model="password"
                  :rules="passwordRules"
                  outlined
                  background-color="white"
                  class="mr-1"
                  
                ></v-text-field>
              </v-col>
              <v-col cols="12" lg="6" md="6" sm="6" xs="12">
                <v-text-field
                  :type="isShowPassword ? 'text' : 'password'"
                  dense
                  class="mr-1"
                  placeholder="Confirm password"
                  v-model="confirmPassword"
                  :rules="passwordConfirmRules"
                  outlined
                  background-color="white"
                ></v-text-field>
              </v-col>
            </v-row>            
            <v-row no-gutters class="ma-0 pa-0">
              <v-col cols="12" class="mt-0 pt-0">
                <v-checkbox
                  v-model="checkbox"
                  label="Show password"
                ></v-checkbox>
              </v-col>
            </v-row>
            <v-radio-group row class="mt-0 pt-0"  v-model="gender">
              <v-radio label="Female" value="female"></v-radio>
              <v-radio label="Male" value="male"></v-radio>
              <v-radio label="Other" value="other"></v-radio>
            </v-radio-group>
            <v-row>
              <v-col cols="12">
                <v-card
                  dense
                  class="d-flex justify-center"
                  color="transparent"
                  elevation="0"
                >
                  <v-btn color="#FF9933" class="white--text" @click="loginToUserAlumni">NEXT</v-btn>
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
  data() {
    return {
      first_name: '',
      last_name: '',
      phone_number: '',
      gender: null,
      password: "",
      confirmPassword: "",
      checkbox: false,
      isShowPassword: false,
      userId: JSON.parse(localStorage.getItem('user')).id,
      alumnis: [],
      
      phoneRules: [(v) => !!v || "Phone number is required"],
      passwordRules: [
        (v) => !!v || "Password is required",
        (v) => (v && v.length >= 8) || "Password at leaste 8 characters",

      ],
      passwordConfirmRules: [
        (v) => !!v || "Confirm password is required",
        (v) => (v && v.length >= 8) || "Confirm Password at leaste 8 characters",
        (v) => v === this.password || "Password must match",
      ],
      nameRules: [(v) => !!v || "Name is required"],
      items: ['2005', '2006', '2007', '2008', '2009', '2020', '2021'],
    };
  },
  watch: {
    checkbox() {
      this.isShowPassword = !this.isShowPassword
    },
    password(){
        if(this.confirmPassword !== this.password){
            this.passwordConfirmRules = ["Password must match"]
        }else{
            this.passwordConfirmRules = []
        }
    },
    confirmPassword(){
        if(this.confirmPassword !== this.password){
            this.passwordConfirmRules = ["Password must match"]
        }else{
            this.passwordConfirmRules = []
        }
    }



  },
  methods: {
    loginToUserAlumni(){
      if (this.password === this.confirmPassword){
        let id = this.alumnis.filter(alumni => alumni.user_id === this.userId);
        let userData = {
          first_name: this.first_name.toUpperCase(),
          last_name: this.last_name.toUpperCase(),
          password: this.password,
          email: JSON.parse(localStorage.getItem('user')).email,
          role: 'alumni',
          phone_number: this.phone_number,
          gender: this.gender,
          alumni_id: id[0].id,
          id: this.userId

        }
        axios.put('/users/'+ this.userId, userData).then(()=>{
          this.$emit('signin', userData);
          this.$router.push('/alumni/profile/'+ userData.first_name).catch(()=>{});
        })
      }
    }
  },
  mounted(){
    axios.get('/alumnis').then((res)=>{
      this.alumnis = res.data.data;
    })
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