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
              src="https://simg.nicepng.com/png/small/136-1366211_group-of-10-guys-login-user-icon-png.png"
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
                  <div class="ml-2">BATCH: {{ alumni.major }} - {{ alumni.batch }}</div>
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
    companies: [
      "NONE",
      "PNC",
      "MANGOBYTE",
      "REAL WAT INT",
      "BIKAY",
      "SUOSDEY",
      "ZINATION",
    ],
    genders: ["NONE", "FEMALE", "MALE", "OTHER"],
    batches: ["NONE", "2021", "2022", "2020", "2021"],
    majors: ["NONE", "WEB", "SNA"],
    alumniList: [
      // {name:"kaka",gender:'female',batch:"Batch - 2021 -WEB",company:'PNC',major:"WEB"},
      // {name:"yaya",gender:'female',batch:"Batch - 2022 -WEB",company:'BIKAY',major:"SNA"},
      // {name:"yuyu",gender:'male',batch:"Batch - 2020 -WEB",company:'ZINATION',major:"WEB"},
      // {name:"kuku",gender:'female',batch:"Batch - 2021 - SNA",company:'MANGOBYTE',major:"WEB"},
    ],
    searchName: "",
    searchBatch: "",
    searchGender: "",
    searchCompany: "",
    searchMajor: "",
  }),
  methods: {
    findAlumniInfo() {
      let alumniLists = [ ];
      axios.get("/users").then((res)=> {
        
        alumniLists = res.data.filter((user)=> user.role === 'alumni' && user.alumni.status == "active");
        this.alumniList = alumniLists
      })
    
      // filter name, batch, gender, major and company
      if(this.searchName!=="" && this.searchBatch!=="" && this.searchGender!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.name.toLowerCase().includes(this.searchName.toLowerCase())
        && alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter search, gender, major and company 
      }else if(this.searchBatch!=="" && this.searchGender!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter batch, gender and major
      }else if(this.searchBatch!=="" && this.searchGender!=="" && this.searchMajor!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        ))
      // filter batch, gender and company
      }else if(this.searchBatch!=="" && this.searchGender!=="" &&this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter batch, major and company
      }else if(this.searchBatch!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter gender, major and company
      }else if(this.searchGender!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter batch with gender
      } else if(this.searchBatch!=="" && this.searchGender!==""){
        this.alumniList = alumniLists.filter((alumni)=>alumni.batch.toLowerCase()===this.searchBatch.toLowerCase() 
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase());

      // filter batch with major
      }else if(this.searchBatch!=="" && this.searchMajor!==""){
        this.alumniList = alumniLists.filter((alumni)=>alumni.batch.toLowerCase()===this.searchBatch.toLowerCase() 
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase());

      // filter batch with company
      }else if(this.searchBatch!=="" && this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>alumni.batch.toLowerCase()===this.searchBatch.toLowerCase() 
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase());

      // filter gender and major
      }else if(this.searchGender!=="" && this.searchMajor!==""){
        this.alumniList = alumniLists.filter((alumni)=>alumni.gender.toLowerCase()===this.searchGender.toLowerCase() 
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase());

      // filter gender with company
      }else if(this.searchGender!=="" && this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>alumni.gender.toLowerCase()===this.searchGender.toLowerCase() 
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase());

      //filter major with company
      }else if(this.searchMajor!=="" && this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>alumni.major.toLowerCase()===this.searchMajor.toLowerCase() 
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase());

      // filter name
      }else if(this.searchName!=="" ){
        this.alumniList = alumniLists.filter((alumni) =>(alumni.name.toLowerCase().includes(this.searchName.toLowerCase())
        ))
      //filter batch
      }else if(this.searchBatch!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()))

      // filter gender
      }else if(this.searchGender!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.gender.toLowerCase()===this.searchGender.toLowerCase()))

      // filter major
      }else if(this.searchMajor!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.major.toLowerCase()===this.searchMajor.toLowerCase()))
      
      //filter company
      }else if(this.searchCompany!==""){
        this.alumniList = alumniLists.filter((alumni)=>(alumni.company.toLowerCase()===this.searchCompany.toLowerCase()))
      } else {
        this.alumniList = alumniLists;
      }
    },
  },
  mounted() {
    this.findAlumniInfo();
    
  },
};
</script>