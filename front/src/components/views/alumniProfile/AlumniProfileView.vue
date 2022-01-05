<template>
  <v-container class="mt-9" width="50%">
    <v-card height="22vh" class="elevation-0"> </v-card>
    <v-hover v-slot="{ hover }">
      <v-container class="header d-flex elevation-0">
        <v-col cols="5">
          <v-avatar size="170" class="avatar">
            <v-img :src="profile" alt="John"></v-img>
          </v-avatar>
          <label for="profile"
            ><v-icon
              class="icon align-center rounded-circle pa-1 blue-grey darken-2"
              color="white"
              >mdi-camera</v-icon
            ></label
          >
          <input type="file" id="profile" hidden @change="selectProfile" />
          <v-card color="transparent" width="60%" class="elevation-0">
            <v-card-title class="justify-center text-h4 white--text text-wrap">
              {{ alumni.first_name }} {{ alumni.last_name }}
              <v-icon v-if="alumniData.gender === 'female'" class="ml-2"
                >mdi-gender-female</v-icon
              >
              <v-icon v-else class="ml-2">mdi-gender-male</v-icon>
            </v-card-title>
          </v-card>
        </v-col>
        <v-card-text class="mb-0 pb-0">
          <v-card-text class="d-flex ml-0 pl-0 mb-0 pb-0">
            <v-card-subtitle class="white--text text-wrap">
              <v-icon>mdi-phone-classic</v-icon>
              {{ alumniData.phone_number }}
            </v-card-subtitle>
            <v-card-subtitle class="white--text text-wrap">
              <v-icon>mdi-gmail</v-icon>
              {{ alumni.email }}
            </v-card-subtitle>
          </v-card-text>
          <v-card-text class="d-flex ml-0 pl-0 mb-0 pb-0">
            <v-card-subtitle class="mb-0 pb-0 mt-0 pt-0 white--text text-wrap">
              <v-icon>mdi-cloud-tags</v-icon>
              {{ alumniData.major }}
            </v-card-subtitle>
            <v-card-subtitle class="mt-0 pt-0 mb-0 pb-0 white--text text-wrap">
              <v-icon>mdi-certificate</v-icon>
              {{ alumniData.batch }}
            </v-card-subtitle>
            <v-spacer></v-spacer>
            <v-icon
              v-if="hover"
              class="edit pa-2 mr-1 white elevation-6 rounded-circle"
              @click="editData"
              >mdi-pen</v-icon
            >
            <v-dialog v-model="dialog" persistent max-width="500px">
              <v-form ref="form" v-model="valid">
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
                          v-model="firstName"
                          label="First Name"
                          placeholder="First Name"
                          outlined
                          dense
                          width="100px"
                          :rules="[(v) => !!v || 'First name is required']"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          v-model="lastName"
                          label="Last Name"
                          placeholder="Last Name"
                          outlined
                          dense
                          width="100px"
                          :rules="[(v) => !!v || 'Last name is required']"
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
                      v-model="userMajor"
                      label="Major"
                      dense
                      outlined
                      :items="major"
                    ></v-select>
                    <v-select
                      v-model="userBatch"
                      label="Batch"
                      dense
                      outlined
                      :items="batch"
                    ></v-select>
                    <v-radio-group
                      :rules="[(v) => !!v || 'Gender is required']"
                      row
                      class="mt-0 pt-0"
                      v-model="gender"
                    >
                      <v-radio label="Female" value="female"></v-radio>
                      <v-radio label="Male" value="male"></v-radio>
                    </v-radio-group>
                    <v-card-actions class="justify-end">
                      <v-btn color="grey" text @click="closeDialog">
                        <span>Cancel</span>
                      </v-btn>
                      <v-btn
                        :disabled="!valid"
                        color="#22BBEA"
                        class="white--text"
                        @click="completedData"
                      >
                        <span>Update</span>
                      </v-btn>
                      <v-dialog
                        v-model="checkPassword"
                        persistent
                        max-width="500px"
                      >
                        <v-card class="rounded-lg">
                          <v-card-title class="justify-center">
                            <span class="text-h5 text-color"
                              >VERIFY YOUR PASSWORD</span
                            >
                          </v-card-title>
                          <v-card-text>
                            <v-divider
                              color="#FF9933"
                              class="mx-auto mt-3"
                              width="98%"
                            ></v-divider>
                            <form ref="form">
                              <v-row class="mt-6 pt-0" dense>
                              <v-col cols="12">
                                <v-text-field
                                  v-model="password"
                                  label="Password"
                                  placeholder="Password"
                                  type="password"
                                  :rules="passwordRules"
                                  autocomplete="on"
                                  outlined
                                  dense
                                  width="100px"
                                ></v-text-field>
                              </v-col>
                            </v-row>
                            </form>
                            <v-card-actions class="justify-end">
                              <v-btn
                                dark
                                color="grey"
                                text
                                @click="closeDialog"
                              >
                                <span>Cancel</span>
                              </v-btn>
                              <v-btn dark color="#22BBEA" @click="updateData">
                                <span>Confirm</span>
                              </v-btn>
                            </v-card-actions>
                          </v-card-text>
                        </v-card>
                      </v-dialog>
                    </v-card-actions>
                  </v-card-text>
                </v-card>
              </v-form>
            </v-dialog>
          </v-card-text>
        </v-card-text>
      </v-container>
    </v-hover>

    <v-card tile color=" pt-6" class="">
      <skill-card
        :alumni-skills="alumniSkills"
        :alumni-id="alumniData.id"
        @add="getOneAlumni"
      ></skill-card>

      <v-card width="100%" elevation="0" color="transparent" class="pb-6">
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
              <v-form ref="form" class="pa-4" v-model="valid">
                <v-card-title class="d-flex justify-center my-0 py-0">
                  <span class="text-h5 text-color">CREATE EMPLOYMENT</span>
                </v-card-title>
                <v-divider
                  color="#FF9933"
                  class="mx-auto"
                  width="93%"
                ></v-divider>
                <v-container>
                  <v-row class="mt-4">
                    <v-col cols="12" class="pa-0 ma-0">
                      <v-combobox
                        dense
                        outlined
                        :rules="companyRules"
                        v-model="modelCompany"
                        :items="companies"
                        :search-input.sync="searchComapany"
                        label="Company"
                        @change="findCompanyName"
                      >
                        <template v-slot:no-data>
                          <v-list-item scroll>
                            <v-list-item-content>
                              <v-list-item-title>
                                Press <kbd>Enter</kbd> to Create New Company
                                "<strong>{{ searchComapany }}</strong
                                >"
                              </v-list-item-title>
                            </v-list-item-content>
                          </v-list-item>
                        </template>
                      </v-combobox>
                    </v-col>
                    <!-- CompanyDialog -->

                    <v-col cols="12" class="pa-0 ma-0">
                      <v-combobox
                        dense
                        outlined
                        v-model="modelPosition"
                        :items="positions"
                        :rules="positionRules"
                        :search-input.sync="searchPosition"
                        label="Position"
                      >
                      </v-combobox>
                    </v-col>

                    <v-col cols="6" class="pl-0 py-0 ma-0">
                      <v-select
                        v-model="startYear"
                        :items="startYears"
                        label="Start Year"
                        dense
                        :rules="startYearRules"
                        outlined
                      ></v-select>
                    </v-col>
                    <v-col cols="6" class="pr-0 py-0 ma-0">
                      <v-select
                        v-model="endYear"
                        :items="endYears"
                        label="End Year"
                        dense
                        :rules="endYearRules"
                        outlined
                      ></v-select>
                    </v-col>
                  </v-row>
                </v-container>

                <v-card-actions class="m-0 pt-0 mr-4 pr-4 pb-7">
                  <v-spacer></v-spacer>
                  <v-btn dark color="grey" text @click="closeCreateDialog">
                    <span>Cancel</span>
                  </v-btn>
                  <v-btn
                    color="#22BBEA"
                    dark
                    :disabled="!valid"
                    @click="createWorkExperience"
                  >
                    <span>CREATE</span>
                  </v-btn>
                </v-card-actions>
              </v-form>
            </v-card>
          </v-dialog>
          <!-- =======================aaaaa=================== -->
          
          <!-- =======================Company Dialog==================================== -->
          <v-dialog
                      v-model="isInputInfoCompany"
                      persistent
                      max-width="500px"
                    >
                      <v-card>
                        <v-form ref="form" class="pa-4" v-model="valid">
                          <v-card-title class="d-flex justify-center my-0 py-0">
                            <span class="text-h5 text-color"
                              >CREATE Company</span
                            >
                          </v-card-title>
                          <v-divider
                            color="#FF9933"
                            class="mx-auto"
                            width="100%"
                          ></v-divider>
                          <v-container>
                            <v-row class="mt-4">
                              <v-col
                                cols="12"
                                class="
                                  pa-0
                                  mb-3
                                  mt-0
                                  d-flex
                                  align-center
                                  justify-center
                                "
                                v-if="isInputInfoCompany"
                              >
                                <label for="companyImg" class="mx-auto">
                                  <v-avatar id="addCompanyImg" tile size="100">
                                    <v-img
                                      :src="companyLogo"
                                      alt="Company logo"
                                    ></v-img>
                                  </v-avatar>
                                </label>
                                <input
                                  type="file"
                                  accept="image/jpeg, image/png, image/gif"
                                  id="companyImg"
                                  hidden
                                  @change="selectCompanyLogo"
                                />
                              </v-col>
                              <v-col
                                cols="6"
                                class="pl-0 py-0 ma-0"
                                v-if="isInputInfoCompany"
                              >
                                <v-text-field
                                  dense
                                  outlined
                                  :rules="companyPhoneRules"
                                  v-model="companyPhoneNumber"
                                  label="Company Phone Number"
                                >
                                </v-text-field>
                              </v-col>
                              <v-col
                                cols="6"
                                class="pr-0 py-0 ma-0"
                                v-if="isInputInfoCompany"
                              >
                                <v-text-field
                                  dense
                                  outlined
                                  v-model="companyEmail"
                                  label="Company Email"
                                  :rules="companyEmailRules"
                                >
                                </v-text-field>
                              </v-col>
                              <v-col
                                cols="6"
                                class="pl-0 py-0 ma-0"
                                v-if="isInputInfoCompany"
                              >
                                <v-combobox
                                  dense
                                  outlined
                                  v-model="modelCompanyDomain"
                                  :items="companyDomain"
                                  :search-input.sync="searchComapanyDomain"
                                  label="Company Domain"
                                >
                                </v-combobox>
                              </v-col>

                              <v-col
                                cols="6"
                                class="pr-0 py-0 ma-0"
                                v-if="isInputInfoCompany"
                              >
                                <v-combobox
                                  dense
                                  outlined
                                  v-model="modelCompanyAddress"
                                  :items="companyAddresses"
                                  :search-input.sync="searchComapanyAddress"
                                  label="Company Address"
                                >
                                </v-combobox>
                              </v-col>
                            </v-row>
                          </v-container>

                          <v-card-actions class="m-0 pt-0 mr-4 pr-4 pb-7">
                            <v-spacer></v-spacer>
                            <v-btn
                              dark
                              color="grey"
                              text
                              @click="
                                closeCompanyDialog
                              "
                            >
                              <span>Cancel</span>
                            </v-btn>
                            <v-btn
                              color="#22BBEA"
                              :disabled="!valid"
                              @click="createCompany"
                            >
                              <span>Create</span>
                            </v-btn>
                          </v-card-actions>
                        </v-form>
                      </v-card>
                    </v-dialog>
          <!-- ========================================== -->
        </v-card-text>
        <v-divider color="#FF9933" class="mx-auto" width="93%"></v-divider>
        <alumni-current-employment
          v-for="work of workExperience"
          :key="work.id"
          :work="work"
          @get-work-experience="getOneAlumni"
          @get-position-companies="getCompanyAndPosition"
          :companies="companies"
          :positions="positions"
          :workExperience="workExperience"
          :objectCompanies="objectCompanies"
          :objectPositions="objectPositions"
          :startYears="startYears"
          :endYears="endYears"
          :companyDomain="companyDomain"
          :companyAddresses="companyAddresses"
        />
      </v-card>
    </v-card>
  </v-container>
</template>

<script>
import axios from "./../../../api/api.js";
import AlumniCurrentEmployment from "./AlumniCurrentEmployment.vue";
import SkillCard from "./SkillCard.vue";

export default {
  components: {
    AlumniCurrentEmployment,
    SkillCard,
  },
  data() {
    return {
      companyRules:[],
      positionRules:[],
      startYearRules:[],
      endYearRules:[],
      dialog2: false,
      companyPhoneRules: [(v) => !!v || "Phone number is required"],
      companyEmailRules: [
        (v) =>
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3}))$/.test(
            v
          ) || "Invalid Email address",
      ],
      companyLogo:
        "https://cdn2.iconfinder.com/data/icons/business-and-finance-385/30/office_business_work_workplace_home_company-_16-128.png",
      dialog: false,
      valid: true,
      dialogCreate: false,
      checkPassword: false,
      password: "",
      alumni: {},
      user: {},
      alumniData: {},
      currentEmployments: [],
      startYears: [
        "2022",
        "2021",
        "2020",
        "2019",
        "2018",
        "2017",
        "2016",
        "2015",
        "2014",
        "2013",
        "2012",
        "2011",
        "2010",
        "2009",
        "2008",
        "2007",
      ],
      endYears: [
        "Present",
        "2022",
        "2021",
        "2020",
        "2019",
        "2018",
        "2017",
        "2016",
        "2015",
        "2014",
        "2013",
        "2012",
        "2011",
        "2010",
        "2009",
        "2008",
        "2007",
      ],
      startYear: "",
      endYear: "",
      major: ["WEB", "SNA"],
      batch: [
        "Batch-2021",
        "Batch-2020",
        "Batch-2019",
        "Batch-2018",
        "Batch-2017",
        "Batch-2016",
        "Batch-2015",
        "Batch-2014",
        "Batch-2013",
        "Batch-2012",
        "Batch-2011",
        "Batch-2010",
        "Batch-2009",
        "Batch-2008",
        "Batch-2007",
      ],
      companyAddresses: [
        "Phnom Penh",
        "Kampong Thom",
        "Kampong Cham",
        "Kompot",
      ],
      companyDomain: ["Bank", "Insuranc"],
      searchComapanyDomain: "",
      modelCompanyDomain: "",
      modelCompanyAddress: "",
      searchComapanyAddress: "",
      companyPhoneNumber: "",
      companyEmail: "",
      passwordRules: [],
      companies: [],
      positions: [],
      workExperience: [],
      objectCompanies: [],
      objectPositions: [],
      modelPosition: "",
      modelCompany: "",
      searchComapany: null,
      searchPosition: null,
      phoneRule: [],
      emailRules: [],
      email: "",
      phoneNumber: "",
      firstName: "",
      lastName: "",
      userBatch: "",
      userMajor: "",
      gender: "",
      userId: localStorage.getItem("userId"),
      profile: "",
      image: "",
      previewImage: "",
      companyId: null,
      positionId: null,
      isInputInfoCompany: false,
      alumniSkills: [],
    };
  },
  watch: {
    startYear(val){
      if(val===''){
        this.startYearRules=[(v) => !!v || 'Start year is required'];
      } else {
        this.startYearRules = [];
      }
    },
    endYear(val){
      if(val===''){
        this.endYearRules=[(v) => !!v || 'End year is required'];
      } else {
        this.endYearRules = [];
      }
    },
    modelPosition(val){
      if(val==''){
        this.positionRules=[(v) => !!v || 'Position is required'];
      } else {
        this.positionRules = [];
      }
    },
    modelCompany(val){
      if(val==''){
        this.companyRules=[(v) => !!v || 'Company name is required'];
      } else {
        this.companyRules = [];
      }
    },
    companyEmailRules(val) {
      const emailRegex =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3}))$/;
      if (!emailRegex.test(val)) {
        this.emailRules = ["E-mail must be valid"];
      } else {
        this.emailRules = [];
      }
      if (val == "") {
        this.emailRules = ["E-mail is required"];
      }
    },
    companyPhoneNumber(val) {
      this.companyPhoneRules = [
        (v) => !!v || "Phone Number is required",
        (v) =>
          (v.length >= 9 && v.length <= 10 && v[0] == "0") ||
          "Phone Number must be valid",
      ];
      if(val !== ""){
        if (val[1] === "0" || val[1] === "4" || val[1] === "5") {
          this.companyPhoneRules = ["Phone Number must be valid"];
        }
      }
      
    },
    email() {
      this.emailRules = [
        (v) => !!v || "E-mail is required",
        (v) =>
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3}))$/.test(
            v
          ) || "E-mail must be valid",
      ];
    },
    phoneNumber() {
      this.phoneRule = [
        (v) => !!v || "Phone Number is required",
        (v) => /^\d+$/.test(v) || "Must be a number",
        (v) =>
          (v.length >= 9 && v.length <= 10 && v[0] == 0) ||
          "Phone Number must be valid",
      ];
    },
  },
  methods: {
    showNewCompany() {
      this.dialog2 = true;
    },
    findCompanyName() {
      let companyName = this.objectCompanies.filter(
        (company) => company.companyName == this.modelCompany
      );
      if (companyName.length !== 0) {
        this.isInputInfoCompany = false;
      } else {
        this.isInputInfoCompany = true;
        this.dialogCreate = false;
      }
    },
    getOneAlumni() {
      axios
        .get("users/" + JSON.parse(localStorage.getItem("userId")))
        .then((res) => {
          this.alumni = res.data.user;
          this.alumniData = res.data.user.alumni;
          this.workExperience = res.data.workExperience;
          this.alumniSkills = res.data.skills;
          this.profile =
            "http://localhost:8000/storage/profiles/" + this.alumniData.profile;
        });
    },
    closeDialog() {
      this.$refs.form.reset();
      this.dialog = false;
      this.checkPassword = false;
      this.phoneRule = [];
      this.phoneNumber = this.alumniData.phone_number;
    },
    selectCompanyLogo(event) {
      this.image = event.target.files[0];
      this.companyLogo = URL.createObjectURL(this.image);
      let reader = new FileReader();
      reader.onloadend = (event) => {
        this.previewImage = event.target.result;
      };
      reader.readAsDataURL(this.image);
    },
    selectProfile(event) {
      let image = event.target.files[0];
      this.profile = URL.createObjectURL(image);
      let userProfile = new FormData();
      userProfile.append("profile", image);
      userProfile.append("_method", "PUT");

      axios
        .post("/alumnisProfile/" + this.alumniData.id, userProfile)
        .then(() => {
          this.getOneAlumni();
        });
    },
    editData() {
      this.dialog = true;
      this.email = this.alumni.email;
      this.firstName = this.alumni.first_name;
      this.lastName = this.alumni.last_name;
      this.phoneNumber = this.alumniData.phone_number;
      this.userMajor = this.alumniData.major;
      this.userBatch = this.alumniData.batch;
      this.gender = this.alumniData.gender;
    },
    completedData() {
        this.dialog = false;
        this.checkPassword = true;
    },
    updateData() {
      let object = {
        email: this.alumni.email,
        password: this.password,
      };
      let userData = {
        first_name: this.firstName,
        last_name: this.lastName,
        email: this.email,
        password: this.password,
        role: "alumni",
      };
      let alumniData = {
        phone_number: this.phoneNumber,
        gender: this.gender,
        batch: this.userBatch,
        major: this.userMajor,
        user_id: this.alumni.id,
        status: "active",
      };
      axios
        .post("/signin", object)
        .then(() => {
          axios.put("/users/" + this.alumni.id, userData).then(() => {});
          axios.put("/alumnis/" + this.alumniData.id, alumniData).then(() => {
            this.closeDialog();
            this.getOneAlumni();
            this.password = "";

          });
        })
        .catch(() => {
          this.passwordRules = ["Your Password does not exist"];
        });
    },
    closeCreateDialog() {
      this.$refs.form.reset();
      this.dialogCreate = false;
      this.modelCompany = null;
      this.modelPosition = null;
      this.startYear = null;
      this.endYear = null;
      
      this.isInputInfoCompany = false;
    },
    closeCompanyDialog(){
        this.isInputInfoCompany = false;
        this.dialogCreate = true;
        this.companyPhoneNumber = "";
        this.modelCompanyDomain = "";
        this.companyEmail = "";
        this.modelCompanyAddress = "";
        this.companyLogo =
        "https://cdn2.iconfinder.com/data/icons/business-and-finance-385/30/office_business_work_workplace_home_company-_16-128.png";
      
    },
    createCompany() {
      let company = new FormData();
      company.append("companyName", this.modelCompany);
      company.append("phone", this.companyPhoneNumber);
      company.append("email", this.companyEmail);
      company.append("address", this.modelCompanyAddress);
      company.append("domain", this.modelCompanyDomain);
      company.append("logo", this.image);

      axios.post("/companies", company).then((res) => {
        this.$refs.form.reset();
        console.log(res.data);
        this.getCompanyAndPosition();
        this.closeCompanyDialog();
        
      });
    },
    createWorkExperience() {
      let objectOfCompany = this.objectCompanies.filter(
        (company) => company.companyName == this.modelCompany
      );
      let objectOfPosition = this.objectPositions.filter(
        (position) => position.positionName == this.modelPosition
      );
      if (objectOfCompany.length !== 0) {
        this.companyId = objectOfCompany[0].id;
      }
      if (objectOfPosition.length !== 0) {
        this.position = objectOfPosition[0].id;
      } else {
        this.position = this.modelPosition;
      }
      let newWork = new FormData();
      newWork.append("alumni_id", this.alumniData.id);
      newWork.append("company_id", this.companyId);
      newWork.append("position_id", this.position);
      newWork.append("start_year", this.startYear);
      newWork.append("end_year", this.endYear);
      axios.post("work_experiences", newWork).then(() => {
        
        this.$refs.form.reset();
        this.getOneAlumni();
        this.getCompanyAndPosition();
        this.closeCreateDialog();
      });
      
    },

    getCompanyAndPosition() {
      axios.get("companies").then((res) => {
        this.objectCompanies = res.data;
        this.objectCompanies.map((company) => {
          this.companies.push(company.companyName);
        });
      });
      axios.get("positions").then((res) => {
        this.objectPositions = res.data;
        for (let position of this.objectPositions) {
          this.positions.push(position.positionName);
        }
      });
    },
  },
  mounted() {
    this.alumni = JSON.parse(localStorage.getItem("user"));
    this.getOneAlumni();
    this.getCompanyAndPosition();
  },
};
</script>

<style scoped>
.avatar {
  margin-top: -100px;
  margin-left: 7%;
  border: 5px solid rgb(255, 255, 255);
}
#addCompanyImg {
  border: 2px solid rgb(190, 190, 190);
}
.icon {
  margin-left: -9%;
  height: 33px;
}
.header {
  background: #22bbea;
}
.text-color {
  color: #22bbea;
}
.delete {
  height: 40px;
}
</style>