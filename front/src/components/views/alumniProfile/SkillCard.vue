<template>
  <v-container>
    <v-divider></v-divider>

    <v-row justify="center">
      <v-expansion-panels accordion flat >
        <v-expansion-panel>
          <v-expansion-panel-header
            width="100px"
            class="elevation-0 title ml-4 text-h5 blue--text"
            >Skills</v-expansion-panel-header
          >
          <v-expansion-panel-content>
            <v-chip-group active-class="primary--text" column>
              <v-chip v-for="tag in tags" :key="tag">
              <v-hover v-slot="{hover}">

                <v-card-text class="px-0">
                  {{ tag }}
                <v-icon v-if="hover" right>mdi-close-circle-outline</v-icon>
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
                      width="95%"
                    ></v-divider>

                    <v-container class="pb-0 px-0">
                      <v-col cols="12" class="pb-0">
                        <v-combobox
                          v-model="model"
                          :items="tags"
                          :search-input.sync="search"
                          hide-selected
                          label="Add some tags"
                          multiple
                          persistent-hint
                          small-chips
                          outlined
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
                      <span class="white--text" @click="dialog = false">Save</span>
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-chip-group>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
      
    </v-row>
    <v-divider></v-divider>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    tags: [
      "Work",
      "Home Improvement",
      "Vacation",
      "Food",
      "Drawers",
      "Shopping",
      "Art",
      "Tech",
      "Creative Writing",
      "Creative Writing",
      "Creative Writing",
      "Creative Writing",
      "Creative Writing",
      "Creative Writing",
      "Creative Writing",
    ],
    dialog: false,
    model: "",
    search: "",
  }),
};
</script>