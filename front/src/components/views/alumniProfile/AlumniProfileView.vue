<template>
  <v-container width="50%">
    <!-- <v-img
      height="250px"
      src="https://cdn.quotesgram.com/img/99/55/1480966742-banana-potato-song-minions-1.png"
    ></v-img> -->
    <v-card height="25vh" class="elevation-0"> </v-card>
    <v-container class="d-flex blue elevation-0">
        <v-avatar size="170" class="avatar">
          <v-img
            src="https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png"
            alt="John"
          >
            
          </v-img>          
        </v-avatar>
        <label for="profile"><v-icon class="icon align-center rounded-circle pa-1 blue-grey darken-2" color="white">mdi-camera</v-icon></label>
        <input type="file" id="profile" hidden>

      <v-card-text class="mt-0 pt-0 mb-0 pb-0">
        <v-card-title class="mt-0 pt-0 text-h4 white--text"
          >Group09 VC-Part2</v-card-title
        >
        <v-card-text class="d-flex ml-0 pl-0">
          <v-card-subtitle class="mb-0 pb-0 mt-0 pt-0 white--text">
            <v-icon>mdi-briefcase</v-icon>
            Web developer at Mango Byte co, ltd
          </v-card-subtitle>
          <v-card-subtitle class="mb-0 pb-0 mt-0 pt-0 white--text">
            <v-icon>mdi-phone-classic</v-icon>
            0987654321</v-card-subtitle
          >
          <v-card-subtitle class="mt-0 pt-0 white--text">
            <v-icon>mdi-email</v-icon>
            group09@gmail.com
          </v-card-subtitle>
        </v-card-text>
      </v-card-text>
    </v-container>
    <v-card tile color=" pt-6" height="100vh" class="d-flex">
      <v-col cols="4">
        <v-card-title class="justify-center font-weight-bold mb-0 pb-0 text-h5"> More Information </v-card-title>

        <v-col class="ml-5">
          <p class="pt-0">
            <v-icon>mdi-gender-transgender</v-icon>
            : Male
          </p>
          <p class="pt-0">
            <v-icon>mdi-cloud-tags</v-icon>
            : WEB Programming
          </p>
          <p class="pt-0">
            <v-icon>mdi-certificate</v-icon>
            : Batch 2021
          </p>
          <p class="pt-0">Skills: HTML, JS, Node, Laravel, PHP, MySQL, OOP</p>

        </v-col>
         <v-row class="d-flex justify-center mt-2" tile >
            <v-btn class="blue justify-center white--text">Edit</v-btn>
          </v-row>
      </v-col>
      <v-card width="68%" class="ml-6 mr-6">
        <v-text class="d-flex justify-center align-center">
          <h2 class="title mt-4 ml-6 text-h5 text-color">Work Experience</h2>
          <v-spacer></v-spacer>
          <!-- <v-btn class="blue rounded-circle" width="10px"> -->
            <v-icon class="white mr-6 pa-2 elevation-6 rounded-circle my-3 orange--text">mdi-plus</v-icon>
            <!-- Add
          </v-btn> -->
        </v-text>
        <v-divider color="#FF9933" class="mx-auto" width="93%"></v-divider>
        <alumni-current-employment/>
        <alumni-current-employment/>
        <alumni-current-employment/>
        <alumni-current-employment/>
      </v-card>
    </v-card>
  </v-container>
</template>

<script>
import AlumniCurrentEmployment from "./AlumniCurrentEmployment.vue"
export default ({
    components:{
        AlumniCurrentEmployment
    },
    data() {
        return{
            dialog: false,
        }
    },
})
</script>


<style scoped>
.avatar {
  margin-top: -100px;
  margin-left: 7%;
  border: 5px solid white;
}
.icon {
  /* margin-left: 100px; */
  position: absolute;
  top: 22%;
  left: 23%;
  /* z-index: 1111; */
  height: 32px;
}
</style>