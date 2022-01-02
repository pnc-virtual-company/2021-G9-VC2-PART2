<template>
  <div>
   
    <v-app-bar
      class=""
      id="main-navbar"
      width="100%"
      height="70px"
      app
      color="white"
    >
      <v-img
        src="./../../assets/PN-Cambodia-Alumni-Association.png"
        max-height="50"
        max-width="150"
        class="ml-8"
      ></v-img>
      <v-tabs
        class="mx-auto d-flex justify-center align-center"
        width="100%"
        color="#FF9933"
      >
        <v-tab
          :to="{ path: '/admin_view' }"
          class="text-h6 blue--text"
          v-if="role === 'admin' || role === 'ero'"
          >Manager Users</v-tab
        >
        <v-tab
          :to="{ path: '/alumni/profile/' + activeUser }"
          class="text-h6 blue--text"
          color="black"
          v-if="role === 'alumni'"
          >My Profile</v-tab
        >
        <v-tab
          :to="{ path: '/explore_alumni' }"
          class="text-h6 blue--text"
          color="black"
          v-if="role === 'admin'"
        >
          Explore Alumnis
        </v-tab>
        <v-tab :to="{ path: '/event' }" class="text-h6 blue--text" color="black"
          >Events</v-tab
        >
      </v-tabs>




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
        <v-dialog v-model="dialog" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="dialog = false">No</v-btn>
              <v-btn color="blue darken-1" text @click="logoutAcout">Yes</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </v-app-bar>
  </div>
</template>
<script>
export default {
  emits: ["sign-out"],
  data() {
    return {
      dialog: false,
      role: JSON.parse(localStorage.getItem("user")).role,
      activeUser: localStorage.getItem("userName"),
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
  mounted() {},
};
</script>
<style scoped>
</style>