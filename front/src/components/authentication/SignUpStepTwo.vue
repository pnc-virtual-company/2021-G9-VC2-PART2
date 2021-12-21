
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
              <v-col cols="12">
                <v-text-field
                  dense
                  class="mr-1"
                  background-color="white"
                  placeholder="E-mail"
                  :rules="emailRules"
                  outlined
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
            <v-row no-gutters>
              <v-col cols="12">
                <v-checkbox
                  v-model="checkbox"
                  label="Show password"
                ></v-checkbox>
              </v-col>
            </v-row>
            <v-row no-gutters>
              <v-col cols="12">
                <router-link
                  class="purple--text text-decoration-underline"
                  to="/"
                  >Have an account yet?</router-link
                >
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
                  <v-btn color="#FF9933" class="white--text">NEXT</v-btn>
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
export default {
  data() {
    return {
      password: "",
      confirmPassword: "",
      checkbox: false,
      isShowPassword: false,
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
      ],
      phoneRules: [(v) => !!v || "Phone number is required"],
      passwordRules: [
        (v) => !!v || "Password is required",
        (v) => (v && v.length >= 8) || "Password at leaste 8 characters",
      ],
      passwordConfirmRules: [
        (v) => !!v || "Confirm password is required",
        (v) => v === this.password || "Password must match",
      ],
    };
  },
  watch: {
    checkbox() {
      this.isShowPassword = !this.isShowPassword
    },
  },
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