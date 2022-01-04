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
                src="http://www.topjobcambodia.com/photos/social/20191010-182540-mango_byte_technology_co_ltd.png"
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
                    >{{ work.start_year }}-
                    {{ work.end_year }}</v-list-item-subtitle
                  >
                </v-list-item-content>
              </v-list-item>
              </v-col>
            </v-list>
            <v-list width="10%">
              <v-icon v-if="hover" @click="getDataToUpdate(work)" class="pa-2 mr-1 white elevation-6 rounded-circle">mdi-pen</v-icon>
              <v-icon v-if="hover" @click="deleteWorkExperience(work.id)" class="pa-2 mr-1 ml-2 white elevation-6 rounded-circle">mdi-delete</v-icon>
              <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
          <v-form class="pt-5 px-5">
            <v-card-title class="d-flex justify-center my-0 py-0">
              <span class="text-h5 text-color">UPDATE EMPLOYMENT</span>
            </v-card-title>
            <v-divider
              color="#FF9933"
              class="mx-auto mt-4"
              width="100%"
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
                <v-col cols="12" class="pa-0 ma-0">
                    <v-combobox
                      dense
                      outlined
                      v-model="modelCompanyAddress"
                      :search-input.sync="searchComapanyAddress"
                      label="Company Address"
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
            <v-btn dark color="grey" text @click="closeDialog">
              <span >Cancel</span>
            </v-btn>
            <v-btn color="#22BBEA" @click="updateworkExperience()">
                <span class="white--text">Submit</span>
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
                  <v-list-item-subtitle class="text-wrap mt-2">Aquation, #540 Koh Pich St, Koh Pich (Diamond Island), Phnom Penh 120101 Cambodia</v-list-item-subtitle>
                </v-list-item-content>
               </v-list-item>
             </v-col>
             <v-col cols="4" class="pl-2">
               <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Contact</v-list-item-title>
                  <v-list-item-subtitle class="mt-2 text-wrap">
                    <v-icon>mdi-phone</v-icon>
                    09232323443
                  </v-list-item-subtitle>
                  <v-list-item-subtitle class="mt-2 text-wrap">
                    <v-icon>mdi-gmail</v-icon>
                    knfkdknj@mangobyte.com
                  </v-list-item-subtitle>
                </v-list-item-content>
               </v-list-item>
             </v-col>
             <v-col cols="3" class="pl-5">
               <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>Domain</v-list-item-title>
                  <v-list-item-subtitle class="mt-2"
                    >Bank</v-list-item-subtitle
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
  emits: ["get-work-experience"],
  props: [
    "work",
    "companies",
    "positions",
    "workExperiences",
    "objectCompanies",
    "objectPositions",
    "startYears",
    "endYears",
  ],
  data() {
    return {
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
    };
  },
  methods: {
    closeDialog() {
      this.dialog = false;
    },
    getDataToUpdate(work) {
      this.dialog = true;
      this.id = work.id;
      this.alumni_id = work.alumni_id;
      this.modelCompany = work.companyName;
      this.modelPosition = work.positionName;
      this.startYear = JSON.stringify(work.start_year);
      this.endYear = work.end_year;
    },
    updateworkExperience() {
      if (
        this.modelPosition !== "" &&
        this.modelCompany !== "" &&
        this.startYear !== "" &&
        this.endYear !== ""
      ) {
        let objectOfCompany = this.objectCompanies.filter(
          (company) => company.companyName == this.modelCompany
        );
        let objectOfPosition = this.objectPositions.filter(
          (position) => position.positionName == this.modelPosition
        );
        let company = null;
        let position = null;
        if (objectOfCompany.length !== 0) {
          company = objectOfCompany[0].id;
        } else {
          company = this.modelCompany;
        }
        if (objectOfPosition.length !== 0) {
          position = objectOfPosition[0].id;
        } else {
          position = this.modelPosition;
        }
        let updateWork = {
          alumni_id: this.alumni_id,
          company_id: company,
          position_id: position,
          start_year: this.startYear,
          end_year: this.endYear,
        };
        axios.put("work_experiences/" + this.id, updateWork).then(() => {
          axios.get("companies").then((res) => {
            this.objectCompanies = res.data;
            for (let company of this.objectCompanies) {
              this.companies.push(company.companyName);
            }
          });
          axios.get("positions").then((res) => {
            this.objectPositions = res.data;
            for (let position of this.objectPositions) {
              this.positions.push(position.positionName);
            }
          });
          this.$emit("get-work-experience");
        });
        this.closeDialog();
      }
    },
    deleteWorkExperience(id) {
      console.log(id);
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