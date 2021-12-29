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
                    :items="model"
                    :search-input.sync="search"
                    multiple
                    small-chips
                    label="Enter Email"
                  >
                  </v-combobox>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#FF9933" dark @click="dialog = false">
                Close
              </v-btn>
              <v-btn color="#22BBEA" dark @click="inviteAlumni">
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
import axios from './../../../api/api.js';
export default {
  emits:['alumni'],
  data: () => ({
    items: [],
    dialog: false,
    alert: false,
    model: [],
    search: null,
    userList: [],
  }),

  watch: {
    model(val, prev) {
      if (val.length === prev.length) return;
      const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      this.model = val.filter((v) => pattern.test(v) && this.userList.filter(user=> user.email === v).length === 0);
      this.items = [];
      
      val.map((v)=>{
        if (pattern.test(v)){
            let object = {
              email: v,
              role: 'alumni',
              status: 'invited'
            }
            this.items.push(object);
        }
        return v;
      });
    },
  },
  methods: {
    inviteAlumni() {
        this.items.map((value)=>{
            axios.post('/users', value).then(()=>{
              this.model = [];
              this.items = [];
              this.$emit('alumni', 'alumni');
            })
        })
      this.alert = true;
      this.dialog = false;
      setTimeout(() => {
        this.alert = false;
      }, 2000);
    },
    
  },
  mounted(){
     axios.get('/users').then((res)=>{
        this.userList = res.data;
    })

    
  }
};
</script>