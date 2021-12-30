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

    <invite-alumni v-if="select.state == 'ALUMNI LIST'" @alumni="getNewUser"></invite-alumni>
    <manage-ero-user @ero="getNewUser" v-else></manage-ero-user>
    <user-data :isAlumni="isAlumni" :desserts="users"></user-data>
  </v-container>
</template>


<script>
import InviteAlumni from "./IniviteAlumni.vue";
import userData from "./../../UI/UserData.vue";
import ManagerEroUser from "./ManageEroUser.vue";
import axios from "./../../../api/api.js";
export default {
  components: {
    "invite-alumni": InviteAlumni,
    "user-data": userData,
    "manage-ero-user": ManagerEroUser,
  },
  data: () => ({
    select: {},
    item: [],
    isAlumni: 'alumni',
    users: [],
   
  }),
  watch: {
    select(val) {
      if(val.state === "ERO USER LIST"){
        this.isAlumni = 'ero';
      }else if(val.state === "ALUMNI LIST"){
        this.isAlumni = 'alumni'; 
      }
      axios.get('/users').then((res)=>{
        console.log(res.data)
        this.users = res.data.filter(user => user.role == this.isAlumni);
      })
    },
  },
  methods:{
    getNewUser(role){
      this.isAlumni = role;
      axios.get('/users').then((res)=>{
        console.log(res.data)
        this.users = res.data.filter(user => user.role == this.isAlumni);
      })
    }
  },
  mounted() {
    const role = JSON.parse(localStorage.getItem('user')).role;
    if (role === 'admin'){
      this.item = [{ state: "ALUMNI LIST" }, { state: "ERO USER LIST" }];
      this.select = { state: "ALUMNI LIST" };
    }else if(role === 'ero'){
      this.item = [{ state: "ALUMNI LIST" }]
      this.select = { state: "ERO USER LIST" };
    }

    
  },
};
</script>


