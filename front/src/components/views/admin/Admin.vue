<template>
  <!-- <div>
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
  </div> -->

    <v-container fluid class="d-flex justify-space-around">


    <!-- <v-container> -->
        <v-container width="95%" height="200px">
            <v-card-title class="text-h6">
              Invite Alumni Here
            </v-card-title>
            <v-divider color="#FF9933" class="mx-auto" width="96%"></v-divider>
  <v-container fluid>
    <v-combobox
      v-model="model"
      :filter="filter"
      :hide-no-data="!search"
      :items="items"
      :search-input.sync="search"
      hide-selected
      label="Invite alumnis here"
      multiple
      small-chips
      solo
    >
      <template v-slot:no-data>
        <v-list-item>
          <span class="subheading">Create</span>
          <v-chip
            :color="`${colors[nonce - 1]} lighten-3`"
            label
            small
          >
            {{ search }}
          </v-chip>
        </v-list-item>
      </template>
      <template v-slot:selection="{ attrs, item, parent, selected }">
        <v-chip
          v-if="item === Object(item)"
          v-bind="attrs"
          :color="`${item.color} lighten-3`"
          :input-value="selected"
          label
          small
        >
          <span class="pr-2">
            {{ item.email }}
          </span>
          <v-icon
            small
            @click="parent.selectItem(item)"
          >
            $delete
          </v-icon>
        </v-chip>
      </template>
      <template v-slot:item="{ index, item }">
        <v-text-field
          v-if="editing === item"
          v-model="editing.text"
          autofocus
          flat
          background-color="transparent"
          hide-details
          solo
          @keyup.enter="edit(index, item)"
        ></v-text-field>
        <v-chip
          v-else
          :color="`${item.color} lighten-3`"
          dark
          label
          small
        >
          {{ item.email }}
        </v-chip>
        <v-spacer></v-spacer>
        <v-list-item-action @click.stop>
          <v-btn
            icon
            @click.stop.prevent="edit(index, item)"
          >
            <v-icon>{{ editing !== item ? 'mdi-pencil' : 'mdi-check' }}</v-icon>
          </v-btn>
        </v-list-item-action>
      </template>
    </v-combobox>
  </v-container>

        <v-row>
          <v-spacer></v-spacer>
          <v-btn color="#FF9933" class="mr-6" @click="inviteAlumni">Invite</v-btn>
        </v-row>
        </v-container>
        <v-container width="25%">
        <v-col cols="12" >
          <v-card color="#FF9933 " dark class="text-center" :to="{ path: '/card' }">
            <v-card-title class="text-h4">
              ALUMNI LOGIN
            </v-card-title>
            <v-card-text class="text-h3 ">
              {{ alumnis.length }} people
            </v-card-text>
          </v-card>
        </v-col>
        <v-col cols="12" >
            <v-card
            color="#22BBEA"
            dark
            class="text-center"
          >
            <v-card-title class="text-h4">
              ALUMNI INVITE
            </v-card-title>
            <v-card-text class="text-h3 ">
              {{ alumnisInvite.length }} people
            </v-card-text>
          </v-card>
        </v-col>
        </v-container>
        <!-- </v-col> -->
      <!-- </v-row> -->
    <!-- </v-container> -->
    </v-container>
</template>
<script>
import axios from './../../../api/api.js';
export default {
  data: () => ({
    alumnisInvite: [],
    alumnis: [],
    dialog: false,
    alert: false,
    // items: [],
    values: null,
    activator: null,
      attach: null,
      colors: ['green', 'purple', 'indigo', 'cyan', 'teal', 'orange'],
      editing: null,
      editingIndex: -1,
      items: [
        { header: 'Select an option or create one' },
      ],
      nonce: 1,
      menu: false,
      model: [
        
      ],
      x: 0,
      search: null,
      y: 0,
  }),
   watch: {
      model (val, prev) {
        // console.log(val, prev);
        if (val.length === prev.length) return

        this.model = val.map(v => {
          if (typeof v === 'string') {
            v = {
              email: v,
              color: this.colors[this.nonce - 1],
            }

            this.items.push(v);
            // this.model.push(v);

            this.nonce++
          }

          return v
        })
      },
      alert(new_val) {
      if (new_val) {
        setTimeout(() => {
          this.alert = false;
        }, 2000);
      }
    },
    },
  methods: {
    inviteAlumni() {
      console.log(this.model);
      for(let user of this.model){
          let alumni = {
          email: user.email,
          role: 'alumni'
        }
        axios.post('/users', alumni).then(()=>{
          // console.log(res.data);
          this.items = [];
          this.model = [];
          this.getuserInvite();
        }).catch((error)=>{
          console.log(error);
        })
      }
      
      
    },



    edit (index, item) {
      console.log(index, ' ', item);
        if (!this.editing) {
          this.editing = item
          this.editingIndex = index
        } else {
          this.editing = null
          this.editingIndex = -1
        }
      },
      filter (item, queryText, itemText) {
        if (item.header) return false

        const hasValue = val => val != null ? val : ''

        const text = hasValue(itemText)
        const query = hasValue(queryText)

        return text.toString()
          .toLowerCase()
          .indexOf(query.toString().toLowerCase()) > -1
      },

      getuserInvite(){
        axios.get('/users').then((res)=>{
          this.alumnisInvite = res.data.filter(user => user.first_name === null && user.last_name === null);
          // console.log(this.alumnis);
        })
      }
  },

  mounted(){
    axios.get('/alumnis').then((res)=>{
      this.alumnis = res.data.data.filter(alumni => alumni.gender !== null);
      console.log(this.alumnis);
    })
    this.getuserInvite();
  }
};
</script>