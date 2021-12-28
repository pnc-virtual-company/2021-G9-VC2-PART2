<template>
  <v-hover v-slot="{ hover }">
    <v-card
      class="order-3 pa-2 mx-auto mt-5 rounded-lg d-flex"
      outlined
      tile
      width="93%"
    >
      <v-list class="d-flex" width="92%">
        <v-img
          src="http://www.topjobcambodia.com/photos/social/20191010-182540-mango_byte_technology_co_ltd.png"
          width="90"
        ></v-img>
        <v-list-item two-line>
          <v-list-item-content>
            <v-list-item-title>Company</v-list-item-title>
            <v-list-item-subtitle class="mt-2">{{work.companyName}}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item two-line>
          <v-list-item-content>
            <v-list-item-title>Position</v-list-item-title>
            <v-list-item-subtitle class="mt-2"
              >{{work.positionName}}</v-list-item-subtitle
            >
          </v-list-item-content>
        </v-list-item>
        <v-list-item two-line>
          <v-list-item-content>
            <v-list-item-title>Years</v-list-item-title>
            <v-list-item-subtitle class="mt-2"
              >{{work.start_year}}- {{work.end_year}}</v-list-item-subtitle
            >
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-icon v-if="hover" @click="dialog = !dialog" class="edit pa-2 white elevation-6 rounded-circle">mdi-pen</v-icon>
      <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
          <v-form class="pt-5 px-5">
            <v-card-title class="d-flex justify-center my-0 py-0">
              <span class="text-h5 text-color">UPDATE EMPLOYMENT</span>
            </v-card-title>
            <v-divider
              color="#FF9933"
              class="mx-auto mt-4"
              width="95%"
            ></v-divider>

            <v-container>
              <v-row no-gutters>
                <v-col cols="12" class="mt-4">
                  <v-text-field dense label="Company" outlined></v-text-field>
                </v-col>
              </v-row>
              <v-row no-gutters>
                <v-col cols="12">
                  <v-text-field dense label="Position" outlined></v-text-field>
                </v-col>
              </v-row>
              <v-row class="mt-0 pb-0" dense>
                <v-col cols="6">
                  <v-select
                    :items="startYear"
                    label="Start Year"
                    dense
                    outlined
                  ></v-select>
                </v-col>
                <v-col cols="6">
                  <v-select
                    :items="endYear"
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
            <v-btn dark color="#FF9933" @click="dialog = false">
              <span >Cancel</span>
            </v-btn>
            <v-btn color="#22BBEA" @click="dialog = false">
                <span class="white--text">Submit</span>
              </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card>
  </v-hover>
</template>

<script>
export default {
  props:['work'],
  data() {
    return {
      dialog: false,
      startYear: ['2021', '2020', '2019', '2018', '2017', '2016', '2015', '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007'],
      endYear: ['Prenent', '2021', '2020', '2019', '2018', '2017', '2016', '2015', '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007'],
    };
  },
  methods: {},
};
</script>

<style scoped>
.edit {
  height: 39px;
  margin-top: 40px;
}

.text-color {
  color: #22bbea;
}
</style>
