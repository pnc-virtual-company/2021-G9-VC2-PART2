<template>
  <v-container class="mt-10 pa-5">
    <v-row>
      <!-- personal data container -->
      <v-col cols="12" lg="4" md="4" sm="4" xs="12" class="pa-3">
        <v-card class="grey lighten-1 pa-5">
          <v-text-field
            dense
            placeholder="Search alumni's name"
            type="text"
            outlined
            background-color="white"
            append-icon="mdi-magnify"
            v-model="searchName"
            @input="findAlumniInfo"
          ></v-text-field>
          <v-select
            :items="batches"
            label="Batch"
            dense
            outlined
            background-color="white"
            v-model="searchBatch"
            @input="findAlumniInfo"
          ></v-select>
          <v-select
            :items="genders"
            label="Gender"
            dense
            outlined
            background-color="white"
            v-model="searchGender"
            @input="findAlumniInfo"
          ></v-select>
          <v-select
            :items="majors"
            label="Major"
            dense
            outlined
            background-color="white"
            v-model="searchMajor"
            @input="findAlumniInfo"
          ></v-select>
          <v-select
            :items="companies"
            class="pink"
            hide-details
            label="Company"
            dense
            outlined
            background-color="white"
            v-model="searchCompany"
            @input="findAlumniInfo"
          ></v-select>
        </v-card>
      </v-col>
      <!-- personal data container -->
      <!-- ================================== -->
      <v-col cols="12" lg="8" md="8" sm="8" xs="12" class="pa-3 ma-0">
        <!-- right side data -->
        <v-card class="grey lighten-1 pa-5">
          <!-- one card -->
          <!-- one card -->
          <v-card
            class="mx-auto mb-2 pa-2 d-flex"
            color="white"
            width="100%"
            v-for="alumni of alumniList"
            :key="alumni.id"
          >
            <v-img
              class="white--text align-end rounded-circle"
              max-height="80"
              max-width="80"
              :src="'http://localhost:8000/storage/profiles/' + alumni.alumni.profile"
            >
            </v-img>
            <v-card-text
              class="
                text--primary
                ml-3
                d-flex
                align-center
                justify-space-between
              "
              width="85%"
            >
              <h2>{{ alumni.first_name }} {{alumni.last_name}}</h2>
              <div>
                <div>WEB Development at PNC</div>
                <div class="d-flex align-center">
                  <img
                    
                    style="width: 30px; border-radius: 50%; height: 30px;"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                  />
                  <div class="ml-2">{{ alumni.alumni.major }} - {{ alumni.alumni.batch }}</div>
                </div>
              </div>
            </v-card-text>
          </v-card>
          <!-- one card -->
        </v-card>
        <!-- one card -->
      </v-col>
      <!-- =========================== -->
    </v-row>
  </v-container>
</template>
<script>
import axios from './../../../api/api.js';
export default {
  data: () => ({
    companies: [],
    genders: ["NONE", "FEMALE", "MALE", "OTHER"],
    batches: ['Batch-2021', 'Batch-2020','Batch-2019','Batch-2018','Batch-2017','Batch-2016','Batch-2015','Batch-2014','Batch-2013','Batch-2012','Batch-2011','Batch-2010','Batch-2009','Batch-2008','Batch-2007'],
    majors: ["NONE", "WEB", "SNA"],
    alumniList: [],
    searchName: "",
    searchBatch: "",
    searchGender: "",
    searchCompany: "",
    searchMajor: "",
    alumniLists: [],
  }),
  methods: {
    findAlumniInfo() {
      
      if (
        this.searchName !== "" &&
        this.searchBatch !== "" &&
        this.searchGender !== "" &&
        this.searchMajor !== "" &&
        this.searchCompany !== ""
      ) {
        this.alumniList = this.alumniLists.filter(
          (alumni) =>
            alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase()) &&
            alumni.batch.toLowerCase() === this.searchBatch.toLowerCase() &&
            alumni.gender.toLowerCase() === this.searchGender.toLowerCase() &&
            alumni.major.toLowerCase() === this.searchMajor.toLowerCase() &&
            alumni.company.toLowerCase() === this.searchCompany.toLowerCase()
        );
      } else if (this.searchName !== "") {
        this.alumniList = this.alumniLists.filter((alumni) =>
          alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        );
      } else if (this.searchBatch !== "" && this.searchBatch !== "NONE") {
        this.alumniList = this.alumniLists.filter(
          (alumni) =>
            alumni.alumni.batch === this.searchBatch
        );
      } else if (this.searchGender !== "" && this.searchGender !== "NONE") {
        this.alumniList = this.alumniLists.filter(
          (alumni) =>
            alumni.alumni.gender.toLowerCase() === this.searchGender.toLowerCase()
        );
      } else if (this.searchMajor !== ""  && this.searchMajor !== "NONE") {
        this.alumniList = this.alumniLists.filter(
          (alumni) =>
            alumni.alumni.major.toLowerCase() === this.searchMajor.toLowerCase()
        );
      } else if (this.searchCompany !== "" && this.searchCompany !== "NONE") {
        // axios.get('/work_experiences?' + )
        this.alumniList = this.alumniLists.filter(
          (alumni) =>
            alumni.company.toLowerCase() === this.searchCompany.toLowerCase()
        );
      } else {
        this.alumniList = this.alumniLists;
      }
    },
  },
  mounted() {
    axios.get("/users").then((res)=> {
        this.alumniLists = res.data.filter((user)=> user.role === 'alumni' && user.alumni.status == "active");
        this.alumniList = this.alumniLists;
      })
    this.findAlumniInfo();
    axios.get('/companies').then((res)=>{
      this.companies = res.data;
    })
  },
};
</script>