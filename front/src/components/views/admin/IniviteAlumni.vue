<template>
  <v-container class="ma-0 pa-0 mb-5">
    <v-alert
      v-model="alert"
      dismissible
      border="left"
      dense
      class="white--text"
      type="success"
    >
      You've <strong>Invited</strong> new alumni successfully!.
    </v-alert>
    <v-container>
      <v-row>
        <v-dialog v-model="dialog" persistent max-width="600px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="#FF9933" dark v-bind="attrs" v-on="on">
              invite alumni
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">Insert alumni's Email</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-combobox
                    outlined
                    append-icon
                    v-model="model"
                    :items="items"
                    :search-input.sync="search"
                    multiple
                    small-chips
                  >
                  </v-combobox>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">
                Close
              </v-btn>
              <v-btn color="blue darken-1" text @click="inviteAlumni">
                invite
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </v-container>
  </v-container>
</template>

    
<script>
export default {
  data: () => ({
    items: [],
    dialog: false,
    alert: false,
    model: [],
    search: null,
    nonce: 1,
  }),

  // watch: {
  //   model(val, prev) {
  //     if (val.length === prev.length) return;
  //     const emailRegex = /^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i;
  //     this.model = val.map((v) => {
  //       if (typeof v === "string") {
  //         if (emailRegex.test(v)) {
  //           v = {
  //             text: v,
  //             color: this.colors[this.nonce - 1],
  //           };

  //           this.items.push(v);

  //           this.nonce++;
  //         }
  //       }

  //       return v;
  //     });
  //   },
  // },
  methods: {
    inviteAlumni() {
      this.alert = true;
      this.dialog = false;
      setTimeout(() => {
        this.alert = false;
      }, 4000);
    },
  },
};
</script>