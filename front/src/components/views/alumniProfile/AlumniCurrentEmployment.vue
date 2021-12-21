<template>
<v-hover v-slot="{ hover }">
    <v-card
        class="order-3 pa-2 mx-auto mt-5 rounded-lg d-flex "
        outlined
        tile
        width="93%"
        >
            <v-list class="d-flex" width="95%">
                <v-img src="http://www.topjobcambodia.com/photos/social/20191010-182540-mango_byte_technology_co_ltd.png" width="90"></v-img>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-title>Company</v-list-item-title>
                        <v-list-item-subtitle class="mt-2">Mango Byte</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-title>Position</v-list-item-title>
                        <v-list-item-subtitle class="mt-2">Web Developer</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-title>Years</v-list-item-title>
                        <v-list-item-subtitle class="mt-2">2010-present</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-icon v-if="hover" @click="dialog = !dialog">mdi-pen</v-icon>
            <v-dialog
            v-model="dialog"
            max-width="500px"
            >
            <v-card>
            <v-form>
    <v-container>
      <v-row no-gutters>
        <v-col
          cols="12"
        >
          <v-text-field
           dense
            label="Outlined"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col
          cols="12"
        >
          <v-text-field
           dense
            label="Outlined"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row no-gutters>
        <v-col
          cols="12"
          
        >
          <v-text-field
           dense
            label="Outlined"
            outlined
          ></v-text-field>
        </v-col>
      </v-row>
    </v-container>
  </v-form>

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
        <!-- </v-btn> -->
        </v-card>
</v-hover>
</template>

<script>
// import AlumniCurrentEmployment from "./AlumniCurrentEmployment.vue"
export default ({
    components:{
        // AlumniCurrentEmployment
    },
    data() {
    return{
        dialog:false,
    }
},
methods:{
    
},
})
</script>