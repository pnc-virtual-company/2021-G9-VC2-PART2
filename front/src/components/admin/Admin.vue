<template>
  <div>
    <v-row class="d-flex">
      <v-alert
        class="ma-auto"
        :value="alert"
        border="top"
        color="red lighten-2"
        dark
      >
        I'm an alert with a top border and red color
      </v-alert>
    </v-row>
    <v-row class="ma-10">
      <v-dialog v-model="dialog" persistent max-width="500px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="#22BBEA" dark v-bind="attrs" v-on="on"> Invite </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="text-h5 blue--text">INVITE ALUMNI</span>
          </v-card-title>
          <v-card-text class="pb-0">
            <v-text-field dense placeholder="E-mail" outlined> </v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              Close
            </v-btn>
            <v-btn color="blue darken-1" text @click="inviteAlumni">
              Invite
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    alert: false,
  }),
  methods: {
    inviteAlumni() {
      this.dialog = false;
      this.alert = true;
    },
  },
  watch: {
    alert(new_val) {
      if (new_val) {
        setTimeout(() => {
          this.alert = false;
        }, 2000);
      }
    },
  },
  mounted(){
  }
};
</script>