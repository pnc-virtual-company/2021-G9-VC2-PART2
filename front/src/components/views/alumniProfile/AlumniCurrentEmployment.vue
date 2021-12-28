<template>
  <v-hover v-slot="{ hover }">
    <v-card
      class="order-3 pa-2 mx-auto mt-5 rounded-lg d-flex"
      outlined
      tile
      width="93%"
    >
      <v-list class="d-flex" width="95%">
        <v-img
          src="http://www.topjobcambodia.com/photos/social/20191010-182540-mango_byte_technology_co_ltd.png"
          width="90"
        ></v-img>
        <v-list-item two-line>
          <v-list-item-content>
            <v-list-item-title>Company</v-list-item-title>
            <v-list-item-subtitle class="mt-2">Mango Byte</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item two-line>
          <v-list-item-content>
            <v-list-item-title>Position</v-list-item-title>
            <v-list-item-subtitle class="mt-2"
              >Web Developer</v-list-item-subtitle
            >
          </v-list-item-content>
        </v-list-item>
        <v-list-item two-line>
          <v-list-item-content>
            <v-list-item-title>Years</v-list-item-title>
            <v-list-item-subtitle class="mt-2"
              >2010-present</v-list-item-subtitle
            >
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-icon v-if="hover" @click="dialog = !dialog">mdi-pen</v-icon>
      <v-dialog v-model="dialog" max-width="500px">
        <v-card>
          <v-form class="pt-5 px-5">
            <v-card-title class="d-flex justify-center my-0 py-0">
              <span class="text-h5 text-color">CREATE EMPLOYMENT</span>
            </v-card-title>
            <v-divider
              color="#FF9933"
              class="mx-auto mt-4"
              width="95%"
            ></v-divider>

            <v-container>
              <v-row no-gutters>
                <v-col cols="12" class="mt-4">
                   <v-combobox
                        dense
                        outlined
                        v-model="modelCompany"
                        :items="comapanies"
                        :search-input.sync="searchCompany"
                        label="Company"
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
            <v-btn color="#22BBEA" @click="dialog = false">
                <span class="white--text">Submit</span>
                <v-icon right class="white--text">mdi-account-edit</v-icon>
              </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card>
  </v-hover>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      comapanies: ["Mango Byte", "Zenation", "AMAZOME", "UDAYA"],
      positions: ["Gaming", "Programming", "Vue", "Vuetify"],
      modelCompany: "",
      modelPosition: "",
      searchCompany: null,
      searchPosition: null,
      startYear: ["2021", "2020", "2019", "2018"],
      endYear: ["Present", "2021", "2020", "2019", "2018"],
    };
  },
  methods: {},
};
</script>

<style scoped>
.text-color {
  color: #22bbea;
}
</style>
