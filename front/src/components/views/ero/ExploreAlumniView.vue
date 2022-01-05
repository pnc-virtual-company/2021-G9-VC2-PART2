<template>
  <v-container>
    <v-row class="my-4 d-flex">
      <v-col cols="10">
        <search-button @searchValue="getSearchName"></search-button>
      </v-col>
      <v-col cols="2">
        <!-- <v-btn color="blue" class="py-5">Search More</v-btn> -->
        <v-btn color="grey" text height="100%" @click.stop="searchMore = !searchMore">
          <!-- <v-icon>$expand</v-icon> -->
          Search More
        </v-btn>
      </v-col>
    </v-row>
    <transition name="slide-fade">
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
    </transition>
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
    genders: ["None","FEMALE", "MALE"],
    batches: ["None",'Batch-2021', 'Batch-2020','Batch-2019','Batch-2018','Batch-2017','Batch-2016','Batch-2015','Batch-2014','Batch-2013','Batch-2012','Batch-2011','Batch-2010','Batch-2009','Batch-2008','Batch-2007'],
    majors: ["None","WEB", "SNA"],
    skills: [],
    companies: [],
    alumniList: [],
    searchName: "None",
    searchBatch: "None",
    searchGender: "None",
    searchCompany: "None",
    searchMajor: "None",
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
      
      if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
 
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
    
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
      
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))

      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
  
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
  
      }else if( this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
    
      } else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))

    
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
  
        ))

      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        ))
     
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))

      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
 
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
      
      }else if(this.searchName!=="None" && this.searchGender!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      
      }else if(this.searchName!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
   
        ))
      }else if(this.searchName!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchBatch!=="None" && this.searchGender!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if( this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
      }else if( this.searchBatch!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if( this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchGender!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        ))
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        
        ))
      }else if(this.searchName!=="None" && this.searchBatch!=="None" && this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()

        ))
      }else if(this.searchName!=="None" && this.searchGender!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchGender!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
      }else if(this.searchName!=="None" && this.searchGender!=="None" && this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        ))
      }else if(this.searchName!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
      }else if( this.searchBatch!=="None" && this.searchGender!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchBatch!=="None" && this.searchGender!=="None" && this.searchCompany!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
      }else if(this.searchBatch!=="None" && this.searchGender!=="None" && this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        ))
      }else if(this.searchBatch!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchBatch!=="None"  && this.searchMajor!=="None"  && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>( alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchBatch!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>( alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        
        ))
      }else if( this.searchGender!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if( this.searchGender!=="None" && this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if( this.searchGender!=="None" && this.searchMajor!=="None" && this.searchCompany!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        ))
      }else if(this.searchMajor!=="None" && this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchBatch!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        ))
      }else if(this.searchName!=="None" && this.searchGender!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        ))
      }else if(this.searchName!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchName!=="None" && this.searchCompany!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && this.getCompany(alumni.workExperience)===this.searchCompany

        ))
      }else if(this.searchName!=="None" && this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>((alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase()))
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
    
        ))
      }else if(this.searchBatch!=="None" && this.searchGender!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
      
        ))
        
      }else if(this.searchBatch!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if( this.searchBatch!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
       
        ))
      }else if(this.searchBatch!=="None" && this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
    
        ))
      }else if(this.searchGender!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchGender!=="None" && this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
       
        ))
      }else if(this.searchGender!=="None" && this.searchMajor!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()
        && alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        ))
      }else if(this.searchCompany!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(this.getCompany(alumni.workExperience)===this.searchCompany
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchMajor!=="None" && this.searchSkill!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getSkill(alumni.skills)===this.searchSkill
        ))
      }else if(this.searchMajor!=="None" && this.searchCompany!=="None" ){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()
        && this.getCompany(alumni.workExperience)===this.searchCompany
      
        ))
      }else if(this.searchName!=="None" ){
        
        this.alumniList = allAlumni.filter((alumni)=>(alumni.first_name.toLowerCase().includes(this.searchName.toLowerCase())
        || alumni.last_name.toLowerCase().includes(this.searchName.toLowerCase())
        ))
      }
      else if(this.searchBatch!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.batch.toLowerCase()===this.searchBatch.toLowerCase()))

      }else if(this.searchGender!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.gender.toLowerCase()===this.searchGender.toLowerCase()))
      
      }else if(this.searchMajor!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>(alumni.alumni.major.toLowerCase()===this.searchMajor.toLowerCase()))
      }else if(this.searchCompany!=="None"){
        this.alumniList = allAlumni.filter((alumni)=>this.getCompany(alumni.workExperience)===this.searchCompany)
      } else if (this.searchSkill!==""){
        this.alumniList = allAlumni.filter((alumni)=> this.getSkill(alumni.skills)===this.searchSkill)
      }
      else {
        this.alumniList = allAlumni;
      }
    },
    getSkill(skillList){
      let skill = skillList.filter((title)=>title.Title===this.searchSkill)
      if (skill.length !== 0){
        return skill[0].Title
      }
      // return null
    },
    getCompany(companyList){
      let company = companyList.filter((title)=>title.companyName===this.searchCompany)
      if (company.length !== 0){
        return company[0].companyName
      }
      // return null
    }
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


<style scoped>
.slide-fade-enter-active {
  transition: all 1s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to{
  transform: translateY(-30px);

}
</style>