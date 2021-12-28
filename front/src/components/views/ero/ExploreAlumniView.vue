<template>
  <v-container class="mt-10 pa-5">
    <v-row>
      <!-- personal data container -->
      <v-col cols="12" lg="4" md="4" sm="4" xs="12" class="pa-3">
        <v-card class="grey lighten-1 pa-5">
          <v-text-field
            dense
            placeholder="Search alumni's name"
            type="text"
            outlined
            background-color="white"
            append-icon="mdi-magnify"
            v-model="searchName"
            @input="findAlumniInfo"
          ></v-text-field>
          <v-select
            :items="batches"
            label="Batch"
            dense
            outlined
            background-color="white"
            v-model="searchBatch"
            @input="findAlumniInfo"
          ></v-select>
          <v-select
            :items="genders"
            label="Gender"
            dense
            outlined
            background-color="white"
            v-model="searchGender"
            @input="findAlumniInfo"
          ></v-select>
          <v-select
            :items="majors"
            label="Major"
            dense
            outlined
            background-color="white"
            v-model="searchMajor"
            @input="findAlumniInfo"
          ></v-select>
          <v-select
            :items="companies"
            class="pink"
            hide-details
            label="Company"
            dense
            outlined
            background-color="white"
            v-model="searchCompany"
            @input="findAlumniInfo"
          ></v-select>
        </v-card>
      </v-col>
      <!-- personal data container -->
      <!-- ================================== -->
      <v-col cols="12" lg="8" md="8" sm="8" xs="12" class="pa-3 ma-0">
        <!-- right side data -->
        <v-card class="grey lighten-1 pa-5">
          <!-- one card -->
          <!-- one card -->
          <v-card
            class="mx-auto mb-2 pa-2 d-flex"
            color="white"
            width="100%"
            v-for="alumni of alumniList"
            :key="alumni.id"
          >
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
              <h2>{{ alumni.name }}</h2>
              <div>
                <div>WEB Development at PNC</div>
                <div class="d-flex align-center">
                  <img
                    
                    style="width: 30px; border-radius: 50%; height: 30px;"
                    src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png"
                    alt=""
                  />
                  <div class="ml-2">BATCH: {{ alumni.major }} - {{ alumni.batch }}</div>
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
    companies: [
      "NONE",
      "PNC",
      "MANGOBYTE",
      "REAL WAT INT",
      "BIKAY",
      "SUOSDEY",
      "ZINATION",
    ],
    genders: ["NONE", "FEMALE", "MALE", "OTHER"],
    batches: ["NONE", "2021", "2022", "2020", "2021"],
    majors: ["NONE", "WEB", "SNA"],
    alumniList: [
      // {name:"kaka",gender:'female',batch:"Batch - 2021 -WEB",company:'PNC',major:"WEB"},
      // {name:"yaya",gender:'female',batch:"Batch - 2022 -WEB",company:'BIKAY',major:"SNA"},
      // {name:"yuyu",gender:'male',batch:"Batch - 2020 -WEB",company:'ZINATION',major:"WEB"},
      // {name:"kuku",gender:'female',batch:"Batch - 2021 - SNA",company:'MANGOBYTE',major:"WEB"},
    ],
    searchName: "",
    searchBatch: "",
    searchGender: "",
    searchCompany: "",
    searchMajor: "",
  }),
  methods: {
    findAlumniInfo() {
      let alumniLists = [
        {
          id: 1,
          name: "kaka",
          gender: "female",
          batch: "2021",
          company: "PNC",
          major: "WEB",
        },
        {
          id: 2,
          name: "yaya",
          gender: "female",
          batch: "2020",
          company: "BIKAY",
          major: "SNA",
        },
        {
          id: 3,
          name: "yuyu",
          gender: "male",
          batch: "2020",
          company: "ZINATION",
          major: "WEB",
        },
        {
          id: 4,
          name: "kuku",
          gender: "female",
          batch: "2021",
          company: "MANGOBYTE",
          major: "WEB",
        },
      ];
      if (
        this.searchName !== "" &&
        this.searchBatch !== "" &&
        this.searchGender !== "" &&
        this.searchMajor !== "" &&
        this.searchCompany !== ""
      ) {
        this.alumniList = alumniLists.filter(
          (alumni) =>
            alumni.name.toLowerCase().includes(this.searchName.toLowerCase()) &&
            alumni.batch.toLowerCase() === this.searchBatch.toLowerCase() &&
            alumni.gender.toLowerCase() === this.searchGender.toLowerCase() &&
            alumni.major.toLowerCase() === this.searchMajor.toLowerCase() &&
            alumni.company.toLowerCase() === this.searchCompany.toLowerCase()
        );
      } else if (this.searchName !== "") {
        this.alumniList = alumniLists.filter((alumni) =>
          alumni.name.toLowerCase().includes(this.searchName.toLowerCase())
        );
      } else if (this.searchBatch !== "" && this.searchBatch !== "NONE") {
        this.alumniList = alumniLists.filter(
          (alumni) =>
            alumni.batch.toLowerCase() === this.searchBatch.toLowerCase()
        );
      } else if (this.searchGender !== "" && this.searchGender !== "NONE") {
        this.alumniList = alumniLists.filter(
          (alumni) =>
            alumni.gender.toLowerCase() === this.searchGender.toLowerCase()
        );
      } else if (this.searchMajor !== ""  && this.searchMajor !== "NONE") {
        this.alumniList = alumniLists.filter(
          (alumni) =>
            alumni.major.toLowerCase() === this.searchMajor.toLowerCase()
        );
      } else if (this.searchCompany !== "" && this.searchCompany !== "NONE") {
        this.alumniList = alumniLists.filter(
          (alumni) =>
            alumni.company.toLowerCase() === this.searchCompany.toLowerCase()
        );
      } else {
        this.alumniList = alumniLists;
      }
    },
  },
  mounted() {
    this.findAlumniInfo();
  },
};
</script>