<template>
    <v-card
    class="mx-auto pa-1"
    max-width="1004"
    tile
        >   
    <!-- <v-img
    height="100%"
    src="https://venngage-wordpress.s3.amazonaws.com/uploads/2018/09/Colorful-Circle-Simple-Background-Image-1.jpg"
    > -->
        <v-row
        align="end"
        >
        <v-col
        align-self="start"
        cols="12"
        class="d-flex justify-space-between"
        >
        <v-avatar
        class="profile mt-10 ml-10"
        size="250"
        tile
        >
            <v-img :src="profile"></v-img>
            <div class="align-self-end camera">
                <label for="change"><v-icon class="mdi-36px" color="#E3F2FD">mdi-camera-party-mode</v-icon></label>
                <input type="file" id="change" hidden @change="selectProfile">
            </div>
        </v-avatar>
        <v-hover v-slot="{ hover }">
            <v-col class="py-0 mt-8 ml-16 d-flex">
                <v-list-item
                dark
                color="pink"
                >    
                    <v-list-item-content class="black--text">
                        <v-list-item-title class="text-h4 text-color">
                            Somphors Ngoun
                        </v-list-item-title>
                        <v-list-item-title class="text-h6 mt-4 d-flex">
                            Generation:
                            <v-list-item-title class="mt-1 ml-1 font-weight-light">
                                Batch 2021
                            </v-list-item-title>
                        </v-list-item-title>
                        <v-list-item-title class="text-h6 mt-4 d-flex">
                            Major:
                            <v-list-item-title class="mt-1 ml-1 font-weight-light">
                                WEP
                            </v-list-item-title>
                        </v-list-item-title>
                        <v-list-item-title class="text-h6 mt-4 d-flex">
                            Gender:
                            <v-list-item-title class="mt-1 ml-1 font-weight-light">
                                Female
                            </v-list-item-title>
                        </v-list-item-title>
                        <v-list-item-title class="text-h6 mt-4 d-flex">
                            Tel:
                            <v-list-item-title class="mt-1 ml-1 font-weight-light">
                                097 49 11 250
                            </v-list-item-title>
                        </v-list-item-title>
                        <v-list-item-title class="text-h6 mt-4 d-flex">
                            Email:
                            <v-list-item-title class="mt-1 ml-1 font-weight-light">
                                somphorsngoun@gmail.com
                            </v-list-item-title>
                        </v-list-item-title>
                    </v-list-item-content>
                    
                </v-list-item>
                <!-- <v-divider class="mr-6"></v-divider> -->
                <v-icon class="align-self-end mr-16 mb-3" v-if="hover" @click="dialog = !dialog" >mdi-pen</v-icon>
                <v-dialog
                    v-model="dialog"
                    max-width="500px"
                    >
                    <v-card>
                    <v-card-text>
                    <v-text-field label="File name"></v-text-field>

                    <small class="grey--text">* This doesn't actually save.</small>
                    </v-card-text>

                    <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                    text
                    color="primary"
                    @click="dialog = false"
                    >
                    Submit
                    </v-btn>
                    </v-card-actions>
                    </v-card>
                </v-dialog>
                </v-col>
            </v-hover>
            <!-- <v-btn color="" class=""> -->
                
            <!-- </v-btn> -->

            </v-col>
        
        <v-container fluid class="mb-9">
            <v-divider color="#FF9933" class="mx-auto" width="93%"></v-divider>
            <h2 class="title mt-4 text-h5 text-color">Current Employment</h2>
            <alumni-current-employment/>
        </v-container>
        </v-row>
        <!-- </v-img> -->
    </v-card>
</template>
<script>
// import axios from "./../../../api/api.js";
import AlumniCurrentEmployment from "./AlumniCurrentEmployment.vue"
export default ({
    components:{
        AlumniCurrentEmployment
    },
    data() {
    return{
        profile: 'https://64.media.tumblr.com/daaaed4e9727956224b76102781efb09/09ed29dff71fda55-d0/s640x960/3181a0e5a8d4ced7e3a4e45fb497dd21467fe005.jpg',
        dialog:false,
        alumni: {},
    }
},
methods:{
    selectProfile(event){
        let image = event.target.files[0];
        this.profile = URL.createObjectURL(image);
    }
},
mounted(){
    
    
}
})
</script>


<style scoped>
.title{
    margin-left: 50px;
    font-weight: bold;
}
.camera{
    margin-left: -40px;
/* / background: rgb(206, 206, 206); / */
}
.text-color{
    color: #22BBEA;
}

</style>