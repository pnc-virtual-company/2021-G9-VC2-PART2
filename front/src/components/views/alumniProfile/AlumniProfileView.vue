<template>
  <v-container width="50%">
    <v-card height="22vh" class="elevation-0"> </v-card>
    <v-container class="header d-flex elevation-0">
        <v-avatar size="170" class="avatar">
          <v-img :src="profile" alt="John"></v-img>          
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
    <v-card tile color=" pt-6" class="d-flex">
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
            <v-btn class="justify-center white--text" color="#22BBEA" @click="editData">Edit</v-btn>
            <v-dialog v-model="dialog" persistent max-width="500px">
              <v-card class="rounded-lg">
                <v-card-title class="justify-center">
                  <span class="text-h5 text-color">USER PROFILE</span>
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
                        v-model="alumni.first_name"
                        label="First Name"
                        placeholder="First Name"
                        outlined
                        dense
                        width="100px"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                      <v-text-field
                        v-model="alumni.last_name"
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
                        v-model="phoneNumber"
                        label="Phone Number"
                        placeholder="Phone Number"
                        :rules="phoneRule"
                        outlined
                        dense
                        width="100px"
                      ></v-text-field>
                    </v-col>
                  </v-row>

                  <v-text-field
                    v-model="email"
                    label="Email"
                    placeholder="Email"
                    :rules="emailRules"
                    outlined
                    dense
                    width="100px"
                  ></v-text-field>

                  <v-select
                    v-model="alumniData.major"
                    label="Major"
                    dense
                    outlined
                    :items="major"
                  ></v-select>
                  <v-select
                    v-model="alumniData.batch"
                    label="Batch"
                    dense
                    outlined
                    :items="batch"
                  ></v-select>
                  <v-radio-group row class="mt-0 pt-0" v-model="alumniData.gender">
                    <v-radio label="Female" value="female"></v-radio>
                    <v-radio label="Male" value="male"></v-radio>
                  </v-radio-group>
                  <v-card-actions class="justify-end">
                    <v-btn color="#FF9933" dark @click="closeDialog">
                      <span>Cancel</span>
                    </v-btn>
                    <v-btn color="#22BBEA" dark @click="completedData">
                      <span>Update</span>
                    </v-btn>
                    <v-dialog v-model="checkPassword" persistent max-width="500px">
                      <v-card class="rounded-lg">
                        <v-card-title class="justify-center">
                          <span class="text-h5 text-color">VERIFY YOUR PASSWORD</span>
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
                              v-model="password"
                                label="Password"
                                placeholder="Password"
                                type="password"
                                :rules="passwordRules"
                                outlined
                                dense
                                width="100px"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                          <v-card-actions class="justify-end">
                            <v-btn dark color="#FF9933" @click="closeDialog">
                              <span >Cancel</span>
                            </v-btn>
                            <v-btn dark color="#22BBEA" @click="updateData">
                              <span >Confirm</span>
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
            <v-icon
            @click="dialogCreate = !dialogCreate"
            class="white mr-6 pa-2 elevation-6 rounded-circle my-3 orange--text"
            >mdi-plus</v-icon
          >
          <v-dialog v-model="dialogCreate" persistent max-width="500px">
        <v-card>
          <v-form class="pt-5 px-5">
            <v-card-title class="d-flex justify-center my-0 py-0">
              <span class="text-h5 text-color">CREATE EMPLOYMENT</span>
            </v-card-title>
            <v-divider
              color="#FF9933"
              class="mx-auto mt-4"
              width="95%"
            ></v-divider>

            <v-container>
              <v-row no-gutters>
                <v-col cols="12" class="mt-4">
                   <v-combobox
                        dense
                     
                        outlined
                        v-model="modelCompany"
                        :items="companies"
                        :search-input.sync="searchComapany"
                        label="Company"
                    >
                    </v-combobox>
                </v-col>
              </v-row>
              <v-row no-gutters>
                <v-col cols="12">
                   <v-combobox
                        dense
                        outlined
                        v-model="modelPosition"
                        :items="positions"
                        :search-input.sync="searchPosition"
                        label="Position"
                      >
                      </v-combobox>
                </v-col>
              </v-row>
              <v-row class="mt-0 pb-0" dense>
                <v-col cols="6">
                  <v-select
                    v-model="startYear"
                    :items="startYears"
                    label="Start Year"
                    dense
                    outlined
                  ></v-select>
                </v-col>
                <v-col cols="6">
                  <v-select
                    v-model="endYear"
                    :items="endYears"
                    label="End Year"
                    dense
                    outlined
                  ></v-select>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
          <v-card-actions class="m-0 pt-0 mr-4 pr-4 pb-7">
            <v-spacer></v-spacer>
            <v-btn dark color="#FF9933" @click="closeCreateDialog">
              <span >Cancel</span>
            </v-btn>
            <v-btn color="#22BBEA" @click="createWorkExperience">
                <span class="white--text">Submit</span>
              </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
        </v-card-text>
        <v-divider color="#FF9933" class="mx-auto" width="93%"></v-divider>
        <alumni-current-employment
        v-for="work of workExperience" :key="work.id"
        :work='work'
        @get-work-experience = "getWorkExperience"
        :companies='companies'
        :positions='positions'
        :workExperience='workExperience'
        :objectCompanies='objectCompanies'
        :objectPositions='objectPositions'
        :startYears='startYears'
        :endYears='endYears'
        />
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
      // profile:"https://ussecuritysupply.com/wp-content/uploads/2013/05/default_avatar.png",
      dialog: false,
      dialogCreate:false,
      checkPassword: false,
      password: '',
      alumni: {},
      user:{},
      alumniData: {},
      currentEmployments: [],
      startYears: ['2021', '2020', '2019', '2018', '2017', '2016', '2015', '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007'],
      endYears: ['Prenent', '2021', '2020', '2019', '2018', '2017', '2016', '2015', '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007'],
      startYear : '',
      endYear:'',
      major: ["WEB", "SNA"],
      batch: ['Batch-2021', 'Batch-2020','Batch-2019','Batch-2018','Batch-2017','Batch-2016','Batch-2015','Batch-2014','Batch-2013','Batch-2012','Batch-2011','Batch-2010','Batch-2009','Batch-2008','Batch-2007'],
      passwordRules: [],
      companies:[],
      positions:[],
      workExperience:[],
      objectCompanies:[],
      objectPositions:[],
      modelPosition:'',
      modelCompany:'',
      searchComapany:null,
      searchPosition:null,
      phoneRule: [],
      emailRules: [],
      email: '',
      phoneNumber: '',
      userId: localStorage.getItem('userId'),
      profile: '',
      image: '',
    };
  },
  watch:{
    email(){
      this.emailRules = [(v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",]
    },
    phoneNumber(){
      this.phoneRule = [
        (v) => !!v || "Phone Number is required",
        (v) => /^\d+$/.test(v) || 'Must be a number',
        (v) => v.length>=9 && v.length<=10  && v[0] == 0 || "Phone Number must be valid",]
    }
  },
  methods: {
    getOneAlumni(){
      axios.get('/users/'+ this.userId).then((res)=>{
        this.alumni = res.data;
        this.alumniData = this.alumni.alumni;
        this.profile = 'http://localhost:8000/storage/profiles/' + this.alumniData.profile;
      })
    },
    closeDialog(){
      this.dialog = false;
      this.checkPassword = false;
      this.phoneRule = [];
    },
    selectProfile(event) {
      let image = event.target.files[0];
      this.profile = URL.createObjectURL(image);
      let userProfile = new FormData();
      userProfile.append('profile', image);
      userProfile.append("_method",  "PUT")
      axios.post('/alumnisProfile/'+ this.alumniData.id, userProfile).then(()=> {
        this.getOneAlumni();
      })
    },
    editData(){
      this.dialog = true;
      this.email = this.alumni.email;
      this.phoneNumber = this.alumniData.phone_number;
    },
    completedData(){
      if (this.email.split('@')[0]+ '@gmail.com' === this.email && this.phoneNumber[0] == 0 && this.phoneNumber.length >= 9 && this.phoneNumber.length <= 10){
        this.dialog = false;
        this.checkPassword = true;
      }else{
        this.phoneRule = [(v) => v.length>=9 && v.length<=10  && v[0] == 0 || "Phone Number must be valid"]
        this.emailRules = ["E-mail must be valid",]
      }
    },
    updateData(){
      let object = {
        email: this.alumni.email,
        password: this.password,
      }
      this.alumni.email = this.email;
      this.alumniData.phone_number = this.phoneNumber;
      this.alumni.alumni = this.alumniData;
      this.$set(this.alumni, 'password', this.password);

      axios.post('/signin', object)
      .then(()=>{
        axios.put('/users/'+ this.alumni.id, this.alumni).then(()=>{
        })
        axios.put('/alumnis/'+ this.alumniData.id, this.alumniData).then(()=>{
          this.closeDialog();
          this.getOneAlumni();
        })
        this.password = "";
      })
      .catch(()=>{   
        this.passwordRules = ['Your Password does not exist'];
      })
    },
    closeCreateDialog(){
      this.dialogCreate = false;
      this.modelCompany="";
      this.modelPosition="";
      this.startYear="";
      this.endYear="";
    },
    createWorkExperience(){
      if(this.modelPosition!=="" && this.modelCompany!=="" && this.startYear!=="" && this.endYear!==""){
        let objectOfCompany = this.objectCompanies.filter(company=>company.companyName == this.modelCompany);
        let objectOfPosition = this.objectPositions.filter(position=>position.positionName == this.modelPosition);
        let company = null;
        let position = null;
        if (objectOfCompany.length !==0){
          company = objectOfCompany[0].id
        }else{
          company = this.modelCompany;
        }
        if (objectOfPosition.length !==0){
          position = objectOfPosition[0].id
        }else{
          position = this.modelPosition;
        }
        let newWork={
          alumni_id : this.user.alumni.id,
          company_id: company,
          position_id : position,
          start_year : this.startYear,
          end_year : this.endYear,
        };
        axios.post('work_experiences',newWork).then(()=>{
          this.getWorkExperience();
          axios.get('companies').then(res=>{
          this.objectCompanies = res.data;
          for(let company of this.objectCompanies){
            this.companies.push(company.companyName)
          }
          });
          axios.get('positions').then(res=>{
            this.objectPositions = res.data;
            for(let position of this.objectPositions){
              this.positions.push(position.positionName);
            }
          });
        })
       this.closeCreateDialog()
      }
      },
    getWorkExperience(){
      axios.get('work_experiences/'+this.user.alumni.id).then(res=>{
        this.workExperience = res.data;
      })
    }
  },
  mounted() {
    this.alumni = JSON.parse(localStorage.getItem("user"));
    this.getOneAlumni()
    let emplotment = {
      companyName: "PNC",
      position: "Full-Stack Developer",
      year: "2019-Present",
    };
    this.currentEmployments.push(emplotment);
    axios.get('companies').then(res=>{
      this.objectCompanies = res.data;
      for(let company of this.objectCompanies){
        this.companies.push(company.companyName)
      }
    });
    axios.get('positions').then(res=>{
      this.objectPositions = res.data;
      for(let position of this.objectPositions){
        this.positions.push(position.positionName);
      }
    }); 
    axios.get('users/'+ JSON.parse(localStorage.getItem('userId'))).then(res=>{
      this.user = res.data;
      this.getWorkExperience();
    })
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
  top: 17%;
  left: 22%;
  height: 33px;
}
.header{
  background: #22BBEA;
}
.text-color {
  color: #22bbea;
}
</style>