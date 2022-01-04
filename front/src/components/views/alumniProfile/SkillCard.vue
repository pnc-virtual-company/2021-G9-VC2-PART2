<template>
  <v-container>

    <v-row justify="center" >
      <v-expansion-panels  accordion flat >
        <v-expansion-panel class="elevation-1 mt-4 rounded-0" >
          <v-expansion-panel-header
            width="100px"
            class="title  elevation-0 title  text-h5 "
            >Skills</v-expansion-panel-header
          >
          <v-expansion-panel-content>
            <v-chip-group active-class="primary--text" column>
              <v-chip v-for="(skill, index) in alumniSkills" :key="index">
              <v-hover v-slot="{hover}">

                <v-card-text class="px-0">
                  {{ skill.Title }}
                  <v-progress-circular
                    v-if="hover && isDelete"
                    :size="20"
                    :width="2"
                    color="red"
                    indeterminate
                    right
                  ></v-progress-circular>
                <v-icon v-if="hover && !isDelete" right @click="deleteSkill(skill.id)">mdi-close-circle-outline</v-icon>
                </v-card-text>
              </v-hover>
              </v-chip>
              <v-chip @click="dialog = true">
                <v-icon color="blue">mdi-plus</v-icon>
              </v-chip>

              <v-dialog v-model="dialog" persistent max-width="500px">
                <v-card>
                  <v-form class="pt-5 px-5">
                    
                    <v-card-title class="d-flex justify-center my-0 py-0">
                      <span class="text-h5 text-color">Add New Skills</span>
                    </v-card-title>
                    <v-divider
                      color="#FF9933"
                      class="mx-auto mt-4"
                      width="100%"
                    ></v-divider>

                    <v-container class="pb-0 px-0">
                      
                      <v-col cols="12" class="pb-0">
                        <v-combobox
                          v-model="newSkills"
                          :items="skills"
                          :search-input.sync="search"
                          hide-selected
                          label="Add some tags"
                          multiple
                          persistent-hint
                          small-chips
                          outlined
                          @change="getData"
                        >
                          <template v-slot:no-data>
                            <v-list-item scroll>
                              <v-list-item-content>
                                <v-list-item-title>
                                  Press <kbd>Enter</kbd> to Create New
                                "<strong>{{
                                    search
                                  }}</strong
                                  >" 
                                </v-list-item-title>
                              </v-list-item-content>
                            </v-list-item>
                          </template>
                        </v-combobox>
                      </v-col>
                    </v-container>
                  </v-form>
                  <v-card-actions class="m-0 pt-0 mr-4 pr-4 pb-7">
                    <v-spacer></v-spacer>
                    <v-btn dark color="grey" text @click="dialog = false">
                      <span>Cancel</span>
                    </v-btn>
                    <v-btn color="#22BBEA" >
                      <span class="white--text" @click="addNewSkills">Save</span>
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-chip-group>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
      
    </v-row>
  </v-container>
</template>

<script>
import axios from './../../../api/api.js';
export default {
  props:['alumniSkills', 'alumniId'],
  emits: ['add', 'delete'],
  data: () => ({
    skills: [],
    dialog: false,
    // model:'',
    newSkills: [],
    search: '',
    isDelete: false,
  }),
  methods:{
    getData(){
      let array = [];
      for(let skill of this.newSkills){
        for(let sk of skill.split(' ')){
          if((this.alumniSkills.filter(skill=> skill.Title === sk).length ===0) && sk !== ''){
            array.push(sk);

          }
        }
      }
      this.newSkills = array
    },
    getSkills(){
      axios.get('/skills').then((res)=>{
        this.skills = res.data;
      })
    },
    deleteSkill(id){
      this.isDelete = true;
      axios.delete('/alumniSkill/'+id).then(()=>{
        this.$emit('delete');
        // axios.get('/alumniSkill/'+ this.alumni_id).then(()=>{})
        this.getSkills();
        
        setTimeout(() => {
        this.isDelete = false;
      }, 400);
      })
    },
    addNewSkills(){
      let object = {
        alumni_id: this.alumniId,
        skills: this.newSkills
      }
      axios.post('/skills', object).then(()=>{
        this.$emit('add')
        this.getSkills();
        this.dialog = false;
        this.newSkills = [];
      })
    }
  },
  mounted(){
    this.getSkills();
  }
};
</script>
<style scoped>
  .title{
    color: #22bbea;
  }
</style>