<template>
  <v-app-bar class="" width="100%" height="70" app color="white">
    <v-img
      src="./../../assets/PN-Cambodia-Alumni-Association.png"
      max-height="50"
      max-width="150"
      class="ml-8"
    ></v-img>
    <v-spacer></v-spacer>
    <v-tabs
      class="mx-auto d-flex justify-center align-center"
      width="100%"
      color="#FF9933"
    >
      <v-tab
        :to="{ path: '/admin_view' }"
        class="text-h6 blue--text"
        v-if="alumni.role === 'admin'"
        >Manager Users</v-tab
      >
      <v-tab
        :to="{ path: '/ero_officers' }"
        class="text-h6 blue--text"
        v-if="alumni.role === 'ero'"
        >Ero Officer</v-tab>
      <v-tab
        :to="{ path: '/alumni/profile/' + alumni.first_name }"
        class="text-h6 blue--text"
        color="black"
        v-if="alumni.role === 'alumni'"
        >My Profile</v-tab
      >   
      <v-tab
        :to="{ path: '/alumni_users' }"
        class="text-h6 blue--text"
        color="black"
        v-if="alumni.role === 'admin'"
        >
        Explore Alumnis
      </v-tab>
      <v-tab
        :to="{ path: '/event' }"
        class="text-h6 blue--text"
        color="black"
        >Events</v-tab>
    </v-tabs>
    <v-spacer></v-spacer>

    <v-row justify="center">
      <v-btn
        color="#22BBEA"
        width="20px"
        dark
        @click.stop="dialog = true"
        class="mr-13 px-12"
      >
        Logout
      </v-btn>

      <v-dialog v-model="dialog" max-width="290">
        <v-card>
          <v-card-title class="text-h5">
            Are you sure to logout your account?
          </v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
              color="#FF9933"
              text
              @click="dialog = false"
            >
              No
            </v-btn>

            <v-btn color="#22BBEA" text @click="logoutAcout"> Yes </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </v-app-bar>
</template>
<script>
export default {
  props: ["activeUser"],
  emits: ["sign-out"],
  data() {
    return {
      dialog: false,
      alumni: JSON.parse(localStorage.getItem('user')),
      role: this.activeUser.role,
    };
  },
  methods: {
    logoutAcout() {
      this.dialog = false;
      this.$emit("sign-out");
      localStorage.clear();
      this.$router.push("/verify_email").catch(() => {});
    },
  },
  mounted() {
    console.log(this.activeUser);
  },
};
</script>
