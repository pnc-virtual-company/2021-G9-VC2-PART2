<template>
  <v-container class="ma-0 pa-0 mb-5">
    <v-alert
      v-model="alert"
      dismissible
      border="left"
      dense
      class="white--text"
      type="success"
    >
      You've <strong>Created</strong> an ERO Officer.
    </v-alert>
    <v-container >
      <v-row class="d-flex justify-end">
        <v-dialog v-model="dialog" persistent max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="#FF9933" dark v-bind="attrs" v-on="on">
              Add ero officer
            </v-btn>
          </template>
          <v-card>
            <v-form class="pa-2" ref="form" v-model="valid">
              <v-card-title class="d-flex justify-center">
                <span class="text-h5 text-color">CREATE AN ERO OFFICER</span>
              </v-card-title>
              <v-divider
                color="#FF9933"
                class="mx-auto mt-0 mb-7"
                width="95%"
              ></v-divider>
              <v-container>
                <!-- <v-row> -->
                  <v-row>
                    <v-col cols="6" class="mb-0 pb-0 pt-0">
                      <v-text-field
                        v-model="firstName"
                        type="text"
                        dense
                        label="First name"
                        :rules="nameRules"
                        outlined
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6" class="mb-0 pb-0 pt-0">
                      <v-text-field
                        v-model="lastName"
                        type="text"
                        dense
                        :rules="nameRules"
                        label="Last name"
                        outlined
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="12" class="mb-0 pb-0 pt-0">
                      <v-text-field
                        v-model="email"
                        type="email"
                        dense
                        :rules="emailRules"
                        label="E-mail"
                        outlined
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="6" class="mb-0 pb-0 pt-0">
                      <v-text-field
                        :type="isShowPassword ? 'text' : 'password'"
                        dense
                        label="Password"
                        v-model="password"
                        :rules="passwordRules"
                        outlined
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6" class="mb-0 pb-0 pt-0">
                      <v-text-field
                        :type="isShowPassword ? 'text' : 'password'"
                        dense
                        label="Confirm password"
                        v-model="confirmPassword"
                        :rules="passwordConfirmRules"
                        outlined
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-col cols="12" class="mt-0 pt-0 ml-0 pl-0">
                    <v-checkbox
                      class="ma-0 pa-0"
                      v-model="checkbox"
                      label="Show password"
                    ></v-checkbox>
                  </v-col>
                <!-- </v-row> -->
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn dark color="grey" text @click="dialog = false">
                    Close
                  </v-btn>
                  <v-btn color="#22BBEA" class="white--text" :disabled="!valid"  @click="createAnEro">
                    Create
                  </v-btn>
                </v-card-actions>
              </v-container>
            </v-form>
          </v-card>
        </v-dialog>
      </v-row>
    </v-container>
  </v-container>
</template>

    
<script>
import axios from './../../../api/api.js';
export default {
  emits: ['ero'],
  data: () => ({
    valid: true,
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    confirmPassword: "",
    passwordRules: [
      (v) => !!v || "Password is required",
      (v) => (v && v.length >= 8) || "Password at leaste 8 characters",
    ],
    passwordConfirmRules: [
      (v) => !!v || "Confirm password is required",
      (v) => (v && v.length >= 8) || "Confirm Password at leaste 8 characters",
    ],

    nameRules: [(v) => !!v || "Name is required"],
    emailRules: [
      (v) => /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3}))$/.test(v) || "E-mail must be valid",
    ],
    isShowPassword: false,
    checkbox: false,
    alert: false,
    dialog: false,
    
  }),
  methods: {
    createAnEro() {
      let eroData = {
        first_name: this.firstName,
        last_name: this.lastName,
        email: this.email,
        password: this.password,
        role: 'ero'
      };
      axios.post('/users', eroData).then(()=>{
        this.$emit('ero', 'ero');
      })
      
      this.alert = true;
      this.dialog = false;
      this.alert = true;
      setTimeout(() => {
        this.alert = false;
      }, 2000);

    },
  },
  watch: {
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
    checkbox() {
      this.isShowPassword = !this.isShowPassword;
    },
    password() {
      if (this.confirmPassword !== this.password) {
        this.passwordConfirmRules = ["Password must match"];
      } else {
        this.passwordConfirmRules = [];
      }
    },
    confirmPassword() {
      if (this.confirmPassword !== this.password) {
        this.passwordConfirmRules = ["Password must match"];
      } else {
        this.passwordConfirmRules = [];
      }
    },
  },
};
</script>