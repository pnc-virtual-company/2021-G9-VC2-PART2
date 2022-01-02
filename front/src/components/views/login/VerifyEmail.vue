
<template>
  <div
    class="d-flex justify-center align-center flex-column"
    style="height: 100vh"
  >
    <v-form ref="form" v-model="valid">
      <v-card
        width="750px"
        color="#22BBEA"
        elevation="15"
        class="main-container pa-3 d-flex justify-center align-center"
      >
        <v-row class="sub-container">
          <v-col cols="12" xs="12" sm="10" md="6" lg="6">
            <v-card color="transparent" elevation="0" class="pa-5">
              <h1 class="text-center white--text">SIGN IN</h1>

              <v-row no-gutters class="mt-6">
                <v-col cols="12">
                  <v-text-field
                    v-if="true"
                    dense
                    placeholder="E-mail"
                    :rules="emailRules"
                    type="email"
                    outlined
                    background-color="white"
                    v-model="email"
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row class="ma-0 pa-0">
                <v-col cols="12">
                  <v-card
                    dense
                    class="d-flex justify-center"
                    color="transparent"
                    elevation="0"
                  >
                    <v-btn
                      :disabled="!valid"
                      class="white--text"
                      color="#FF9933"
                      @click="verifyEmail"

                      >NEXT</v-btn
                    >
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
    </v-form>
  </div>
</template>

<script>
import axios from "../../../api/api.js";
export default {
  data() {
    return {
      valid:true,
      email: null,
      emailRules: [ v => /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3}))$/.test(v) || 'Invalid Email address' ],
      userList: [],
      userLogin: null,
    };
  },
  methods: {
    verifyEmail() {
      let user = this.userList.filter((user) => user.email === this.email);
      if (user.length === 0) {
        this.emailRules = ["Your Email does not exist"];
      } else {
        if (user[0].first_name === null && user[0].last_name === null) {
          this.$router.push("/alumni_signup").catch(() => {});
        } else {
          this.$router.push("/verify_password").catch(() => {});
        }
        let userEmail = {
          email: user[0].email,
          role: user[0].role,
        };
        localStorage.setItem("user", JSON.stringify(userEmail));
        localStorage.setItem("userId", user[0].id);
      }
    },
  },
  mounted() {
    axios.get("/users").then((res) => {
      this.userList = res.data;
    });
  },
  watch: {
    email(val) {
      const emailRegex =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3}))$/;
      if (!emailRegex.test(val)) {
        this.emailRules = ["E-mail must be valid"];
      } else {
        this.emailRules = [];
      }
      if (val == "") {
        this.emailRules = ["E-mail is required"];
      }
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