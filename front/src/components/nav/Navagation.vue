<template>
    <!-- <v-app app>  -->
      <v-app-bar class="" width="100%" height="70" app color="white">
        <v-img src="https://o.remove.bg/downloads/941ec1ae-e883-4c79-b747-af0987068cb1/PN-Cambodia-Alumni-Association__1_-removebg-preview.png" width="120"></v-img>
        <v-spacer></v-spacer>
        <v-tabs class="mx-auto d-flex justify-center align-center" width="100%" color="#FF9933">
          <v-tab :to="{path: '/admin'}" class="text-h6 blue--text" v-if="role === 'admin'">Administrator</v-tab>
          <v-tab :to="{path: '/ero_officers'}" class="text-h6 blue--text" v-if="role === 'ero' || role === 'admin'">Ero Officer</v-tab>
          <v-tab :to="{path: '/alumni_profile'}" class="text-h6 blue--text" color="black" v-if="role === 'alumni'">My Profile</v-tab>
          <v-tab :to="{path: '/alumni_users'}" class="text-h6 blue--text" color="black" v-if="role === 'admin' || role === 'ero'">Alumnis</v-tab>
        </v-tabs>
        <v-spacer></v-spacer>
        <v-btn color="#22BBEA" class="white--text">Logout</v-btn>
      </v-app-bar>
      
</template>
<script>

export default ({
  data() {
    return{
      role: 'admin',
    }
    
  },
  
})
</script>
