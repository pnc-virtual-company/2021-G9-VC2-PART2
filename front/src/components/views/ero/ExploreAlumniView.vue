<template>
  <v-container class="mt-10 pa-5">
    <v-row>
      <!-- personal data container -->
      <v-col cols="12" lg="4" md="4" sm="4" xs="12" class="pa-3">
        <v-card class="grey lighten-1 pa-5">
          <v-text-field
            dense
            placeholder="Search alumni"
            type="text"
            outlined
            background-color="white"
            append-icon="mdi-magnify"
          ></v-text-field>
          <v-select
            :items="batches"
            label="Batch"
            dense
            outlined
            background-color="white"
          ></v-select>
          <v-select
            :items="genders"
            label="Gender"
            dense
            outlined
            background-color="white"
          ></v-select>
          <v-select
            :items="majors"
            label="Major"
            dense
            outlined
            background-color="white"
          ></v-select>
          <v-select
            :items="companies"
            class="pink"
            hide-details
            label="Company"
            dense
            outlined
            background-color="white"
          ></v-select>
        </v-card>
      </v-col>
      <!-- personal data container -->
      <!-- ================================== -->
      <v-col cols="12" lg="8" md="8" sm="8" xs="12" class="pa-3 ma-0">
        <!-- right side data -->
        <v-card class="grey lighten-1 pa-5">
          <!-- one card -->
          <v-card class="mx-auto mb-2 pa-2 d-flex" color="white" width="100%">
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
              <h2>Somphors NGOUN</h2>
              <div>
                <div>WEB Development at PNC</div>
                <div class="ml-4 d-flex align-center justify-space-between">
                  <img
                    style="width: 30px; border-radius: 50%; height: 26px"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                  />
                  <div>Batch-2021-WEB</div>
                </div>
              </div>
            </v-card-text>
          </v-card>
          <!-- one card -->
          <!-- one card -->
          <v-card class="mx-auto mb-2 pa-2 d-flex" color="white" width="100%">
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
              <h2>Somphors NGOUN</h2>
              <div>
                <div>WEB Development at PNC</div>
                <div class="ml-4 d-flex align-center justify-space-between">
                  <img
                    style="width: 30px; border-radius: 50%; height: 26px"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                  />
                  <div>Batch-2021-WEB</div>
                </div>
              </div>
            </v-card-text>
          </v-card>
          <!-- one card -->
          <!-- one card -->
          <v-card class="mx-auto mb-2 pa-2 d-flex" color="white" width="100%">
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
              <h2>Somphors NGOUN</h2>
              <div>
                <div>WEB Development at PNC</div>
                <div class="ml-4 d-flex align-center justify-space-between">
                  <img
                    style="width: 30px; border-radius: 50%; height: 26px"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                  />
                  <div>Batch-2021-WEB</div>
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
export default {
  data: () => ({
    companies: ["PNC", "MANGOBYTE", "REAL WAT INT", "BIKAY", "SOUSDEY"],
    genders: ["FEMALE", "MALE", "OTHER"],
    batches: [
      "Batch - 2021 -WEB",
      "Batch - 2022 -WEB",
      "Batch - 2020 -WEB",
      "Batch - 2021 - SNA",
    ],
    majors: ["WEB", "SNA"],
  }),
};
</script>