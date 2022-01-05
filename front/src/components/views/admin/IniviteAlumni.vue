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
      You've <strong>Invited</strong> new alumni successfully!.
    </v-alert>
    <v-container>
      <v-row class="d-flex justify-end">
        <v-dialog v-model="dialog" persistent max-width="600px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="#FF9933" dark v-bind="attrs" v-on="on">
              invite alumni
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">Insert alumni's Email</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-combobox
                    outlined
                    append-icon
                    v-model="model"
                    :items="model"
                    :search-input.sync="search"
                    multiple
                    small-chips
                    label="Enter Email"
                    @change="checkEmail"
                  >
                  </v-combobox>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn dark color="grey" text @click="dialog = false">
                Close
              </v-btn>
              <v-btn color="#22BBEA" dark @click="inviteAlumni"> invite </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </v-container>
  </v-container>
</template>
<script>
import axios from "./../../../api/api.js";
export default {
  emits: ["alumni"],
  data: () => ({
    items: [],
    dialog: false,
    alert: false,
    model: [],
    search: null,
    userList: [],
  }),

  methods: {
    checkEmail() {
      let array = [];
      this.items = [];
      const pattern =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      for (let emails of this.model) {
        for (let email of emails.split(" ")) {
          if (
            pattern.test(email) &&
            this.userList.filter((user) => user.email === email).length === 0
          ) {
            let object = {
              email: email,
              role: "alumni",
              status: "invited",
            };
            this.items.push(object);
            array.push(email);
          }
        }
      }
      this.model = array;
    },
    inviteAlumni() {
      axios.post("/users", this.items).then((res) => {
        this.$emit("alumni", "alumni");
        axios.post('/send-mails', this.items).then(()=>{
          this.items = [];
      })
        if (res.data.message === "User Created") {
          this.alert = true;
          setTimeout(() => {
            this.alert = false;
          }, 8000);
        }
        this.getUsers();
      });
      this.model = [];
     
      this.dialog = false;
    },
    getUsers() {
      axios.get("/users").then((res) => {
        this.userList = res.data;
      });
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>