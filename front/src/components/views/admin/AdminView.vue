<template>
  <v-container >    
    <!-- <v-row class="pa-0 ma-0 mt-5"> -->
      <v-col cols="10" lg="5" md="6" sm="8" xs="12" class="mx-auto pb-0 mt-6">
        <v-card elevation="2" id="listContainer">
          <v-tabs fixed-tabs color="#FF9933" height="45px">
            <v-tab class="v-tab-item blue--text" @click="showAlumniData" style="font-size: 13px"
              >ALUMNI LIST</v-tab>
            <v-tab
              @click="showEroData"
              class="v-tab-item blue--text"
              style="font-size: 13px"
              >ERO OFFICER LIST</v-tab>
          </v-tabs>
        </v-card>
        
      </v-col>
      <v-col cols="12">
          <invite-alumni v-if="isSwitched == 'alumni'"></invite-alumni>
          <manage-ero-user v-else></manage-ero-user>
      </v-col>
    <v-col cols="12" >
        <search-button @searchValue="searchValue"></search-button>
    </v-col>
     <v-col>
        <user-data :isAlumni="isSwitched" :desserts="userList" :headers="headers"></user-data>
      </v-col>
  </v-container>
</template>
<script>
import InviteAlumni from "./IniviteAlumni.vue";
import userData from "../../UI/UserData.vue";
// import ManagerEroUser from "./ManageEroUser.vue";
import SearchButton from "../../UI/SearchButton.vue";
import ManageEroUser from './ManageEroUser.vue';
import axios from './../../../api/api.js';
export default {
  components: {
    "search-button": SearchButton,
    "invite-alumni": InviteAlumni,
    "user-data": userData,
    ManageEroUser,
    // "manage-ero-user": ManagerEroUser,
  },
  data: () => ({
    select: { state: "ALUMNI LIST" },
    item: [{ state: "ALUMNI LIST" }, { state: "ERO USER LIST" }],
    isSwitched: 'alumni',
    search:"",
    userList: [],
    allUsers: [],
    headers: [],
    headersAlumni: [
      {text: "First name", align: "start", sortable: false, value: "first_name",},
      { text: "Last name", value: "last_name" },
      { text: "E-mail", value: "email" },
      { text: "Status", value: "status" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    headersEro: [
      {text: "First name", align: "start", sortable: false, value: "first_name",},
      { text: "Last name", value: "last_name" },
      { text: "E-mail", value: "email" },
      { text: "Actions", value: "actions", sortable: false },
    ],
  }),
  watch: {},
  methods: {
    showEroData() {
      this.headers = this.headersEro;
      this.isSwitched = 'ero';
      this.userList = this.allUsers.filter(user => user.role == 'ero');
    },
    showAlumniData(){
      this.headers = this.headersAlumni;
      this.isSwitched = 'alumni';
      this.userList = this.allUsers.filter(user => user.role == 'alumni');
    },
    searchValue(value){
      this.search = value;
      
      // this.userList = this.allUsers.filter(object=> (object.first_name.toLowerCase().includes(this.search.toLowerCase())
      // || object.last_name.toLowerCase().includes(this.search.toLowerCase()) 
      // || object.email.toLowerCase().includes(this.search.toLowerCase())) 
      // && object.role == this.isSwitched);
    }
  },
  mounted() {
    axios.get('/users').then((res)=>{
      this.allUsers = res.data;
      this.showAlumniData();

    })

  },
};
</script>
<style>
@media screen and (min-width: 300px) and (max-width: 760px) {
  #listContainer {
    width: 100%;
  }
}
</style>


