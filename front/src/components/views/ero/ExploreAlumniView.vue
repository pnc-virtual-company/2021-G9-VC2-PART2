<template>
  <v-container>
    <v-row class="my-4 d-flex">
      <v-col cols="10">
        <search-button @searchValue="getSearchName"></search-button>
      </v-col>
      <v-col cols="2">
        <!-- <v-btn color="blue" class="py-5">Search More</v-btn> -->
        <v-expansion-panels focusable>
          <v-expansion-panel  @click.stop="searchMore = !searchMore">
            <v-expansion-panel-header>Search More</v-expansion-panel-header>     
          </v-expansion-panel>
        </v-expansion-panels>
      </v-col>
    </v-row>
    <v-row v-if="searchMore">
      <v-col cols="2">
         <v-select
            :items="genders"
            label="Gender"
            dense
            outlined
            background-color="white"
            v-model="searchGender"
            @input="findAlumniInfo"
          ></v-select>
      </v-col>
      <v-col cols="2">
         <v-select
            :items="majors"
            label="Major"
            dense
            outlined
            background-color="white"
            v-model="searchMajor"
            @input="findAlumniInfo"
          ></v-select>
      </v-col>
      <v-col cols="2">
         <v-select
            :items="batches"
            label="Batch"
            dense
            outlined
            background-color="white"
            v-model="searchBatch"
            @input="findAlumniInfo"
          ></v-select>
      </v-col>
      
      <v-col cols="3">
         <v-select
            :items="companies"
            label="Company"
            dense
            outlined
            background-color="white"
            v-model="searchCompany"
            @input="findAlumniInfo"
          ></v-select>
      </v-col>
      <v-col cols="3">
         <v-select
            :items="skills"
            label="Skill"
            dense
            outlined
            background-color="white"
            
          ></v-select>
      </v-col>
    </v-row>

    <alumni-card v-for="alumni of alumniList" :key="alumni.id"
      :alumni="alumni"
    ></alumni-card>
    
  </v-container>
</template>

<script>
import SearchButton from "./../../UI/SearchButton.vue";
import AlumniCard from "./AlumniCard.vue"
import axios from './../../../api/api.js';
export default {
  components: {
    SearchButton,
    AlumniCard
  },
  data: () => ({
    searchMore: false,
    genders: ["FEMALE", "MALE"],
    batches: ['Batch-2021', 'Batch-2020','Batch-2019','Batch-2018','Batch-2017','Batch-2016','Batch-2015','Batch-2014','Batch-2013','Batch-2012','Batch-2011','Batch-2010','Batch-2009','Batch-2008','Batch-2007'],
    majors: ["WEB", "SNA"],
    skills: [],
    companies: [],
    alumniList: [],
    searchName: "",
    searchBatch: "",
    searchGender: "",
    searchCompany: "",
    searchMajor: "",
    alumnis:[],
    // fullName:'',
  }),
  methods: {
    getSearchName(userName){
      this.searchName = userName;
      this.findAlumniInfo();
    },
    findAlumniInfo() {
      let allAlumni = this.alumnis ;
      console.log(allAlumni)
      
 //==================================================//   
      // filter name, batch, gender, major and company
      if(this.searchName!=="" && this.searchBatch!=="" && this.searchGender!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.name.toLowerCase().includes(this.searchName.toLowerCase())
        && alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
  //===============================================//
      // filter search, gender, major and company 
      }else if(this.searchBatch!=="" && this.searchGender!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter batch, gender and major
      }else if(this.searchBatch!=="" && this.searchGender!=="" && this.searchMajor!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        ))

    //====================================================//
      // filter batch, gender and company
      }else if(this.searchBatch!=="" && this.searchGender!=="" &&this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
  //==========================================================//
      // filter batch, major and company
      }else if(this.searchBatch!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
  //=============================================//
      // filter gender, major and company
      }else if(this.searchGender!=="" && this.searchMajor!=="" &&this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase()
        ))
      // filter batch with gender
      } else if(this.searchBatch!=="" && this.searchGender!==""){
        this.alumniList = allAlumni.filter((alumni)=>alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase() 
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase());

      // filter batch with major
      }else if(this.searchBatch!=="" && this.searchMajor!==""){
        this.alumniList = allAlumni.filter((alumni)=>alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase() 
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase());
//====================================//
      // filter batch with company
      }else if(this.searchBatch!=="" && this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>alumni.batch.toLowerCase()===this.searchBatch.toLowerCase() 
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase());

      // filter gender and major
      }else if(this.searchGender!=="" && this.searchMajor!==""){
        this.alumniList = allAlumni.filter((alumni)=>alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase() 
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase());
//=================================================//
      // filter gender with company
      }else if(this.searchGender!=="" && this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>alumni.gender.toLowerCase()===this.searchGender.toLowerCase() 
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase());
 //=============================================//
      //filter major with company
      }else if(this.searchMajor!=="" && this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>alumni.major.toLowerCase()===this.searchMajor.toLowerCase() 
        && alumni.company.toLowerCase()===this.searchCompany.toLowerCase());
      // filter name
      }else if(this.searchName!=="" ){
        this.alumniList = allAlumni.filter((alumni) =>(alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase())
        ))
      //filter batch
      }else if(this.searchBatch!==""){
        
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()))

      // filter gender
      }else if(this.searchGender!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()))
      // filter major
      }else if(this.searchMajor!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()))
      //===============================================///
      //filter company
      }else if(this.searchCompany!==""){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.toLowerCase()===this.searchCompany.toLowerCase()))
      } else {
        this.alumniList = allAlumni;
      }
    },
  },
  mounted() {
    axios.get("/users").then((res)=> {
        
        this.alumnis = res.data.filter((user)=> user.role === 'alumni' && user.alumni.status === "active");
        this.alumniList = this.alumnis;
    });
    axios.get('/companies').then((res)=>{
      let companyList = res.data;
      for (let company of companyList){
        this.companies.push(company.companyName);
      }
    });
    axios.get('/skills').then((res)=>{
      let skillList = res.data;
      for (let skill of skillList){
        this.skills.push(skill);
      }
    })
    
  },
};
</script>