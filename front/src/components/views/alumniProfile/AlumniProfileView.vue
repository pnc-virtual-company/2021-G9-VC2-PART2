<template>
  <v-container width="50%">
    <!-- <v-img
      height="250px"
      src="https://cdn.quotesgram.com/img/99/55/1480966742-banana-potato-song-minions-1.png"
    ></v-img> -->
    <v-card height="22vh" class="elevation-0"> </v-card>
    <v-container class="header d-flex elevation-0">
        <v-avatar size="170" class="avatar">
          <v-img
            src="https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png"
            alt="John"
          >
            
          </v-img>          
        </v-avatar>
        <label for="profile"><v-icon class="icon align-center rounded-circle pa-1 blue-grey darken-2" color="white">mdi-camera</v-icon></label>
        <input type="file" id="profile" hidden @change="selectProfile">

      <v-card-text class="mt-0 pt-0 mb-0 pb-0">
        <v-card-title class="mt-0 pt-0 text-h4 white--text"
          >{{ alumni.first_name }} {{ alumni.last_name }}</v-card-title
        >
        <v-card-text class="d-flex ml-0 pl-0">
          <v-card-subtitle class="mb-0 pb-0 mt-0 pt-0 white--text">
            <v-icon>mdi-briefcase</v-icon>
            Web developer at Mango Byte co, ltd
          </v-card-subtitle>
          <v-card-subtitle class="mb-0 pb-0 mt-0 pt-0 white--text">
            <v-icon>mdi-phone-classic</v-icon>
            {{ alumniData.phone_number }}
          </v-card-subtitle>
          <v-card-subtitle class="mt-0 pt-0 white--text">
            <v-icon>mdi-email</v-icon>
            {{ alumni.email }}
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
            : {{ alumniData.gender }}
          </p>
          <p class="pt-0">
            <v-icon>mdi-cloud-tags</v-icon>
            : {{ alumniData.major }}
          </p>
          <p class="pt-0">
            <v-icon>mdi-certificate</v-icon>
            : {{ alumniData.batch }}
          </p>
          <p class="pt-0">Skills: HTML, JS, Node, Laravel, PHP, MySQL, OOP</p>

        </v-col>
         <v-row class="d-flex justify-center mt-2" tile >
            <v-btn class="justify-center white--text" color="#22BBEA" @click="dialog = true">Edit</v-btn>
            <v-dialog v-model="dialog" max-width="500px">
              <v-card class="rounded-lg">
                <v-card-title class="justify-center">
                  <span class="text-h5">User Profile</span>
                </v-card-title>
                <v-card-text>
                  <v-divider
                    color="#FF9933"
                    class="mx-auto mt-3"
                    width="98%"
                  ></v-divider>
                  <v-row class="mt-4 pb-0" dense>
                    <v-col cols="6" class="pb-0">
                      <v-text-field
                        label="First Name"
                        placeholder="First Name"
                        outlined
                        dense
                        width="100px"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        label="Last Name"
                        placeholder="Last Name"
                        outlined
                        dense
                        width="100px"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-row class="mt-0 pt-0" dense>
                    <v-col cols="12">
                      <v-text-field
                        label="Phone Number"
                        placeholder="Phone Number"
                        outlined
                        dense
                        width="100px"
                      ></v-text-field>
                    </v-col>
                  </v-row>

                  <v-text-field
                    label="Email"
                    placeholder="Email"
                    outlined
                    dense
                    width="100px"
                  ></v-text-field>

                  <v-select
                    label="Major"
                    dense
                    outlined
                    :items="major"
                  ></v-select>
                  <!-- </v-row>  -->
                  <v-radio-group row class="mt-0 pt-0">
                    <v-radio label="Female" value="radio-1"></v-radio>
                    <v-radio label="Male" value="radio-2"></v-radio>
                  </v-radio-group>
                  <v-card-actions class="justify-end">
                    <v-btn
                      color="primary"
                      @click="
                        checkPassword = true;
                        dialog = false;
                      "
                    >
                      <span>Submit</span>
                      <v-icon right>mdi-account-edit</v-icon>
                    </v-btn>
                    <v-dialog v-model="checkPassword" max-width="500px">
                      <v-card class="rounded-lg">
                        <v-card-title class="justify-center">
                          <span class="text-h5">Verify you password</span>
                        </v-card-title>
                        <v-card-text>
                          <v-divider
                            color="#FF9933"
                            class="mx-auto mt-3"
                            width="98%"
                          ></v-divider>

                          <v-row class="mt-6 pt-0" dense>
                            <v-col cols="12">
                              <v-text-field
                                label="Password"
                                placeholder="Password"
                                outlined
                                dense
                                width="100px"
                              ></v-text-field>
                            </v-col>
                          </v-row>

                          <v-card-actions class="justify-end">
                            <v-btn
                              color="#22BBEA"
                              @click="checkPassword = false"
                            >
                              <span class="white--text">Confirm</span>
                            </v-btn>
                          </v-card-actions>
                        </v-card-text>
                      </v-card>
                    </v-dialog>
                  </v-card-actions>
                </v-card-text>
              </v-card>
            </v-dialog>
          </v-row>
      </v-col>
      <v-card width="68%" class="ml-6 mr-6">
        <v-card-text class="d-flex justify-center align-center">
          <h2 class="title mt-4 ml-6 text-h5 text-color">Work Experience</h2>
          <v-spacer></v-spacer>
          <!-- <v-btn class="blue rounded-circle" width="10px"> -->
            <v-icon class="white mr-6 pa-2 elevation-6 rounded-circle my-3 orange--text">mdi-plus</v-icon>
            <!-- Add
          </v-btn> -->
        </v-card-text>
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
import axios from "./../../../api/api.js";
import AlumniCurrentEmployment from "./AlumniCurrentEmployment.vue";

export default {
  components: {
    AlumniCurrentEmployment,
  },
  data() {
    return {
      profile:
        "https://ussecuritysupply.com/wp-content/uploads/2013/05/default_avatar.png",
      dialog: false,
      alumni: {},
      alumniData: {},
      currentEmployments: [],
      major: ["WEB", "SNA"],
      checkPassword: false,
    };
  },
  methods: {
    selectProfile(event) {
      let image = event.target.files[0];
      this.profile = URL.createObjectURL(image);
    },
  },
  mounted() {
    this.alumni = JSON.parse(localStorage.getItem("user"));
    
    axios.get('/users/'+ this.alumni.id).then((res)=>{
      this.alumni = res.data;
      this.alumniData = res.data.alumni;
      console.log*(this.alumni);
      localStorage.setItem('user', JSON.stringify(this.alumni));
    })
    let emplotment = {
      companyName: "PNC",
      position: "Full-Stack Developer",
      year: "2019-Present",
    };
    // console.log(this.alumni);
    this.currentEmployments.push(emplotment);
  },
};
</script>


<style scoped>
.avatar {
  margin-top: -100px;
  margin-left: 7%;
  border: 5px solid white;
}
.icon {
  position: absolute;
  top: 20%;
  left: 26%;
  height: 33px;
}
.header{
  background: #22BBEA;
}
</style>