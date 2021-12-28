<template>
  <v-container>
    <v-row align="center">
      <v-col class="d-flex" cols="12" sm="6">
        <v-select
          v-model="select"
          :items="item"
          item-text="state"
          return-object
        ></v-select>
      </v-col>
    </v-row>

    <invite-alumni v-if="select.state == 'ALUMNI LIST'"></invite-alumni>
    <manage-ero-user v-else></manage-ero-user>
    <user-data :isAlumni="isAlumni"></user-data>
  </v-container>
</template>


<script>
import InviteAlumni from "./IniviteAlumni.vue";
import userData from "./../../UI/UserData.vue";
import ManagerEroUser from "./ManageEroUser.vue";
export default {
  components: {
    "invite-alumni": InviteAlumni,
    "user-data": userData,
    "manage-ero-user": ManagerEroUser,
  },
  data: () => ({
    select: { state: "ALUMNI LIST" },
    item: [],
    isAlumni: false,
   
  }),
  watch: {
    select() {
      this.isAlumni = !this.isAlumni;
    },
  },
  mounted() {
    const role = JSON.parse(localStorage.getItem('user')).role;
    if (role === 'admin'){
      this.item = [{ state: "ALUMNI LIST" }, { state: "ERO USER LIST" }];
    }else if(role === 'ero'){
      this.item = [{ state: "ALUMNI LIST" }]
    }
    console.log(this.item);
  },
};
</script>


