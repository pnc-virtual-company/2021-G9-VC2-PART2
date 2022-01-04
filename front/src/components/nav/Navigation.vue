<template>
  <section>
    <v-row class="navbar-container d-flex align-center pa-0 ma-0">
      <v-col cols="12" lg="2" md="2" sm="2" xs="12" class="pa-2 ma-0">
        <v-img
          style="height: 70px; width: 160px"
          class="mx-auto"
          src="./../../assets/PN-Cambodia-Alumni-Association.png"
        ></v-img>
      </v-col>
      <v-col
        cols="12"
        lg="8"
        md="8"
        sm="8"
        xs="12"
        style="height: 70px"
        class="d-flex align-center justify-center pa-2 ma-0"
      >
        <v-tabs
          class="d-flex justify-center pa-0 ma-0"
          color="#FF9933"
          background-color="white"
          show-arrows
        >
          <v-tab
            :to="{ path: '/admin_view' }"
            class="text-h6 blue--text item-list"
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
          <v-tab
            :to="{ path: '/event' }"
            class="text-h6 blue--text"
            color="black"
            >Events</v-tab
          >
        </v-tabs>
      </v-col>
      <v-col
        cols="12"
        lg="2"
        md="2"
        sm="2"
        xs="12"
        class="d-flex justify-center pa-2 ma-0"
      >
        <v-btn
          color="#22BBEA"
          width="20px"
          dark
          @click.stop="dialog = true"
          class="px-14 py-2 btn-logout"
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
      </v-col>
    </v-row>
  </section>
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
.navbar-container{
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
</style>