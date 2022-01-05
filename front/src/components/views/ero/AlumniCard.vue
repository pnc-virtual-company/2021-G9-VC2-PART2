<template>
    <v-container class="mx-0 px-0 mb-0 pb-0" @click="selectAlumni(alumni)">
      <v-card class="mx-0 px-0 py-2 pl-2 d-flex justify-center align-center" 
       
      >
        <v-col cols="1">
          <v-avatar size="70">
          <v-img
            :src="'http://localhost:8000/storage/profiles/'+alumni.alumni.profile"
            alt="John"
          ></v-img>
        </v-avatar>
        </v-col>
        <v-col cols="4">
          <v-card-text>
            {{ alumni.first_name }} {{ alumni.last_name }}
            <v-icon color="red lighten-1" v-if="alumni.alumni.gender == 'female'">mdi-gender-female</v-icon>
            <v-icon color="blue" v-else>mdi-gender-male</v-icon>
        </v-card-text>
        </v-col>
        <v-col cols="4">
          <v-card-text v-if="alumni.workExperience.length !== 0" class="align-center">
            <v-icon left>mdi-briefcase</v-icon>
            {{ alumni.workExperience[0].positionName }} at {{ alumni.workExperience[0].companyName }}
        </v-card-text>
        <v-card-text v-if="alumni.workExperience.length === 0" class="align-center">
            <v-icon left>mdi-briefcase</v-icon>
            No Work
        </v-card-text>
        </v-col>
        <v-col cols="3" class="d-flex align-center">
          <img
                    
              style="width: 30px; border-radius: 50%; height: 30px;" class="align-self-center"
              src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
              alt=""
            />
          <v-card-text> 
            {{ alumni.alumni.major }} - {{ alumni.alumni.batch }}
        </v-card-text>
        </v-col>
        
      </v-card>
    </v-container>
</template>
<script>


export default ({
    props:['alumni'],
    data() {
        return{
            
        }
    },
    methods:{
      selectAlumni(alumni){
        localStorage.setItem('userId', alumni.id);
        this.$router.push("/explore_alumni/alumni_profile/"+alumni.id).catch(() => {});
      }
    }
})
</script>
