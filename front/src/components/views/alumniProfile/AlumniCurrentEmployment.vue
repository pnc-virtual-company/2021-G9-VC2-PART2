<template>
  <!-- <v-container> -->
  <v-hover v-slot="{ hover }">
    <v-col class="pb-0 px-0">
      <v-expansion-panels accordion>
        <v-expansion-panel class="rounded-lg">
          <v-expansion-panel-header class="pa-0 ma-0" hide-actions>
            <v-list class="d-flex" width="90%">
              
              <v-col cols="5" class="d-flex">
                <v-img
                :src="'http://localhost:8000/storage/pictures/'+work.logo"
                width="90"
              ></v-img>

                <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Company</v-list-item-title>
                  <v-list-item-subtitle class="mt-2 text-wrap">{{
                    work.companyName
                  }}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              </v-col>
              <v-col cols="4">
                <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Position</v-list-item-title>
                  <v-list-item-subtitle class="mt-2 text-wrap">{{
                    work.positionName
                  }}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              </v-col>
              <v-col cols="3">
                <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Years</v-list-item-title>
                  <v-list-item-subtitle class="mt-2"
                    >{{ work.start_year }} -
                    {{ work.end_year }}</v-list-item-subtitle
                  >
                </v-list-item-content>
              </v-list-item>
              </v-col>
            </v-list>
            <v-list width="10%" v-if="role === 'alumni'">
              <v-icon v-if="hover" @click="getDataToUpdate(work)" class="pa-2 mr-1 white elevation-6 rounded-circle">mdi-pen</v-icon>

              <v-icon v-if="hover" @click="deleteEmployment = true" class="pa-2 mr-1 ml-2 white elevation-6 rounded-circle">mdi-delete</v-icon>
  <!-- ==========================Delete Work Employment Dialog================================================== -->
              <v-dialog v-model="deleteEmployment" max-width="500px">
                <v-card>
                  <v-card-title class="text-h5 justify-center"
                    >Are you sure you want to this card?</v-card-title
                  >
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="grey" text @click="deleteEmployment = false">No</v-btn>
                    <v-btn color="blue darken-1" text @click="deleteWorkExperience(work.id)">Yes</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
  <!-- ===============================Update Work Employment Dialog================================================== -->
              <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
         <v-form class="pt-5 px-5">
                <v-card-title class="d-flex justify-center my-0 py-0">
                  <span class="text-h5 text-color">UPDATE EMPLOYMENT</span>
                </v-card-title>
                <v-divider
                  color="#FF9933"
                  class="mx-auto "
                  width="93%"
                ></v-divider>

                <v-container>
                  <v-row class="mt-4">
                    <v-col
                      cols="12"
                      class="d-flex justify-center pa-0 mb-3 mt-4"
                      v-if="hideLogoComapnay"
                    >
                      <label for="companyImg">
                        <v-avatar id="addCompanyImg" size="70">
                          <v-img
                            :src="companyLogo"
                            alt="Company logo"
                          ></v-img>
                        </v-avatar>
                      </label>
                      <input type="file" accept="image/jpeg, image/png, image/gif" id="companyImg" hidden @change="selectLogoOfCompany" />
                    </v-col>
                     <v-col cols="12" class="pa-0 ma-0">
                      <v-combobox
                        dense
                        outlined
                        v-model="modelPosition"
                        :items="positions"
                        :search-input.sync="searchPosition"
                        label="Position"
                         persistent-hint
                      >
                      <template v-slot:no-data>
                            <v-list-item scroll>
                              <v-list-item-content>
                                <v-list-item-title>
                                  Press <kbd>Enter</kbd> to Create New
                               
                                </v-list-item-title>
                              </v-list-item-content>
                            </v-list-item>
                          </template>
                      </v-combobox>
                    </v-col>
                    <v-col cols="6" class="pl-0 py-0 ma-0">
                      <v-text-field
                        dense
                        outlined
                        v-model="companyPhoneNumber"
                        label="Company Phone Number"
                        v-if="hasComapnyName"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="6" class="pr-0 py-0 ma-0">
                      <v-text-field
                        dense
                        outlined
                        v-model="companyEmail"
                        label="Company Email"
                        v-if="hasComapnyName"
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="6" class="pl-0 py-0 ma-0">
                      <v-combobox
                        dense
                        outlined
                        v-model="modelCompanyDomain"
                        :items="companyDomain"
                        :search-input.sync="searchComapanyDomain"
                        label="Company Domain"
                        v-if="hasComapnyName"
                      >
                      </v-combobox>
                    </v-col>
                   
                     <v-col  cols="6" class="pr-0 py-0 ma-0" >
                      <v-combobox
                        dense
                        outlined
                        v-model="modelCompanyAddress"
                        :items="companyAddresses"
                        :search-input.sync="searchComapanyAddress"
                        label="Company Address"
                         v-if="hasComapnyName"
                      >
                      </v-combobox>
                    </v-col>
                    <v-col cols="6" class="pl-0 py-0 ma-0">
                      <v-select
                        v-model="startYear"
                        :items="startYears"
                        label="Start Year"
                        dense
                        :rules="[(v) => !!v || 'Start year is required']"
                        outlined
                      ></v-select>
                    </v-col>
                    <v-col cols="6" class="pr-0 py-0 ma-0">
                      <v-select
                        v-model="endYear"
                        :items="endYears"
                        label="End Year"
                        dense
                        :rules="[(v) => !!v || 'End year is required']"
                        outlined
                      ></v-select>
                    </v-col>
                  </v-row>
                </v-container>
              </v-form>
          <v-card-actions class="m-0 pt-0 mr-4 pr-4 pb-7">
            <v-spacer></v-spacer>
            <v-btn dark color="grey" text @click="closeDialog">
              <span >Cancel</span>
            </v-btn>
            <v-btn color="#22BBEA" @click="updateworkExperience()">
                <span class="white--text">Create</span>
              </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
            </v-list>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
           <v-list class="d-flex py-0" width="90%">
             <v-col cols="5">
               <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Address</v-list-item-title>
                  <v-list-item-subtitle class="text-wrap mt-2">{{work.address}}</v-list-item-subtitle>
                </v-list-item-content>
               </v-list-item>
             </v-col>
             <v-col cols="4" class="pl-2">
               <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Contact</v-list-item-title>
                  <v-list-item-subtitle class="mt-2 text-wrap">
                    <v-icon>mdi-phone</v-icon>
                    {{work.phone}}
                  </v-list-item-subtitle>
                  <v-list-item-subtitle class="mt-2 text-wrap">
                    <v-icon>mdi-gmail</v-icon>
                    {{work.email}}
                  </v-list-item-subtitle>
                </v-list-item-content>
               </v-list-item>
             </v-col>
             <v-col cols="3" class="pl-5">
               <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Domain</v-list-item-title>
                  <v-list-item-subtitle class="mt-2"
                    >{{work.domain}}</v-list-item-subtitle
                  >
                </v-list-item-content>
               </v-list-item>
             </v-col>
           </v-list>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-col>
  </v-hover>
</template>
<script>
import axios from "./../../../api/api.js";
export default {
  emits: ["get-work-experience", "get-position-companies"],
  props: [
    "work",
    "companies",
    "positions",
    "workExperiences",
    "objectCompanies",
    "objectPositions",
    "startYears",
    "endYears",
    "companyDomain",
    "companyAddresses",
  ],
  data() {
    return {
      companyLogo:
        "https://cdn2.iconfinder.com/data/icons/business-and-finance-385/30/office_business_work_workplace_home_company-_16-128.png",
      dialog: false,
      startYear: null,
      endYear: null,
      searchComapany: null,
      searchComapanyAddress:null,
      searchPosition: null,
      modelPosition: "",
      modelCompany: "",
      modelCompanyAddress: "",
      id: null,
      alumni_id: null,
      previewImage:'',
      image:'',
      companyPhoneNumber:'',
      companyEmail:'',
      modelCompanyDomain:'',
      searchComapanyDomain:'',
      hideLogoComapnay:false,
      hasComapnyName:true,
      company:'',
      position:'',
      companyId:'',
      isSelectCompanyName:false,
      companyIdToEdit:null,
      deleteEmployment: false,
      role: JSON.parse(localStorage.getItem('user')).role,
    };
  },
  methods: {

    closeDialog() {
      this.dialog = false;
      this.hideLogoComapnay = false;
    },
    getDataToUpdate(work) {
      this.dialog = true;
      this.id = work.id;
      this.alumni_id = work.alumni_id;
      this.companyIdToEdit = work.company_id;
      this.modelCompany = work.companyName;
      this.modelPosition = work.positionName;
      this.startYear = JSON.stringify(work.start_year);
      this.endYear = work.end_year;
      this.modelCompanyAddress=work.address;
      this.modelCompanyDomain= work.domain;
      this.companyPhoneNumber= work.phone;
      this.companyEmail = work.email;
      this.image = null;
    },
   
    findNameOfCompany(){
      let companyName = this.objectCompanies.filter(
          (company) => company.companyName == this.modelCompany
        );
      if(companyName.length!==0){
        this.hasComapnyName = false;
        this.hideLogoComapnay= false;
        this.isSelectCompanyName = true;
      }else{
        this.hasComapnyName = true;
        this.hideLogoComapnay= true;
        this.modelCompanyAddress='';
        this.modelCompanyDomain= '';
        this.companyPhoneNumber= '';
        this.companyEmail = '';
        this.modelPosition = '';
        this.startYear = '';
        this.endYear = '';
        
      }
    },
    selectLogoOfCompany(event) {
      this.image = event.target.files[0];
      this.companyLogo = URL.createObjectURL(this.image);
      let reader = new FileReader();
      reader.onloadend = (event) => {
        this.previewImage = event.target.result;
      };
      reader.readAsDataURL(this.image);
    
    },
    updateworkExperience() {
      if (
        this.modelPosition !== "" &&
        this.companyEmail !== "" &&
        this.companyPhoneNumber !== "" &&
        this.modelCompanyDomain !== "" &&
        this.modelCompanyAddress !== "" &&
        this.startYear !== "" &&
        this.endYear !== ""
      ) {

        let objectOfPosition = this.objectPositions.filter(
          (position) => position.positionName == this.modelPosition
        );
        if (objectOfPosition.length !== 0) {
          this.position = objectOfPosition[0].id;
        } else {
          this.position = this.modelPosition;
        }
        let updateWorks = {
          alumni_id:this.alumni_id,
          company_id:this.companyIdToEdit,
          phone: this.companyPhoneNumber,
          email:this.companyEmail,
          address:this.modelCompanyAddress,
          domain:this.modelCompanyDomain,
          position_id:this.position,
          start_year:this.startYear,
          end_year:this.endYear
        }
        axios.put("work_experiences/"+this.id,updateWorks).then(() => {
          this.$emit("get-position-companies")
          this.$emit("get-work-experience");
          this.closeDialog();

        });

      }
    },
    deleteWorkExperience(id) {
      axios.delete("work_experiences/" + id).then(() => {
        this.$emit("get-work-experience");
      });
    },
  },
  mounted() {},
};
</script>
<style scoped>
.text-color {
  color: #22bbea;
}
</style>