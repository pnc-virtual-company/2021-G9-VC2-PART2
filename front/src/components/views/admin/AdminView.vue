<template>
  <v-container >    
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
          <invite-alumni v-if="isSwitched == 'alumni'" @alumni="getAllUsers"></invite-alumni>
          <manage-ero-user v-else @ero="getAllUsers"></manage-ero-user>
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
import SearchButton from "../../UI/SearchButton.vue";
import ManageEroUser from './ManageEroUser.vue';
import axios from './../../../api/api.js';
export default {
  components: {
    "search-button": SearchButton,
    "invite-alumni": InviteAlumni,
    "user-data": userData,
    ManageEroUser,
  },
  
  data: () => ({
    select: { state: "ALUMNI LIST" },
    item: [{ state: "ALUMNI LIST" }, { state: "ERO USER LIST" }],
    isSwitched: 'alumni',
    search:"",
    userList: [],
    allUsers: [],
    alumnilist:[],
    eroList:[],
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
      this.eroList = this.allUsers.filter(user => user.role == 'ero');
      this.userList = this.eroList;
      this.searchValue(this.search);
    },
    showAlumniData(){
      this.headers = this.headersAlumni;
      this.isSwitched = 'alumni';
      this.alumnilist = this.allUsers.filter(user => user.role == 'alumni');
      this.userList =  this.alumnilist
      this.searchValue(this.search); 
    },
    searchValue(value){
      this.search = value;
      if(this.isSwitched==='alumni'){
        
        let users = this.alumnilist;
        this.userList = users.filter(user=>user.first_name.toLowerCase().includes(this.search.toLowerCase())
        || user.last_name.toLowerCase().includes(this.search.toLowerCase()) 
       
        )
      }else if(this.isSwitched==='ero'){
        let users = this.eroList;
        this.userList = users.filter(user=>user.first_name.toLowerCase().includes(this.search.toLowerCase())
        || user.last_name.toLowerCase().includes(this.search.toLowerCase()) 
     
        )
      }
      

      
    },
    getAllUsers(value){
      axios.get('/users').then((res)=>{
      this.allUsers = res.data;
      if(value === 'alumni'){
        this.showAlumniData();
      }else{
        this.showEroData();
      }

    })
    }
  },
  mounted() {
    this.getAllUsers(this.isSwitched);

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


