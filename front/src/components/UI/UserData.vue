<template>
  <v-data-table
    :search="search"
    :headers="headers"
    :items="desserts"
    sort-by="calories"
    class="elevation-15"
  >
    <!-- <v-card width="100%" elevation="0" color="blue">
      <v-card-title class="d-flex justify-between px-0">
        <h2 v-if="isAlumni == 'ero' || isAlumni == 'newEro'">ERO</h2>
        <h2 v-else>ALUMNI</h2>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
    </v-card> -->
    
    <template v-slot:body="{ items }">
     
      <tbody>
        <tr
          v-for="item in items"
          :key="item.id"
          :search="search"
          @mouseover="selectItem(item)"
          @mouseleave="unSelectItem()"
        >
          <td>{{ item.first_name }}</td>
          <td>{{ item.last_name }}</td>
          <td>{{ item.email }}</td>
          <td v-if="item.role === 'alumni'">{{ item.alumni.status }}</td>
          <td>
            <div v-if="item === selectedItem">
              <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
                color="#22BBEA"
              >
                mdi-pencil
              </v-icon>
              <v-icon small @click="deleteItem(item)" color="#FF9933">
                mdi-delete
              </v-icon>
            </div>
          </td>
        </tr>
      </tbody>
      <v-dialog v-model="dialogDelete" max-width="500px">
        <v-card>
          <v-card-title class="text-h5"
            >Are you sure you want to delete this item?</v-card-title
          >
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="grey" text @click="closeDelete">No</v-btn>
            <v-btn color="blue darken-1" text @click="deleteItemConfirm"
              >Yes</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
  </v-data-table>
</template>
<script>
import axios from './../../api/api.js';
export default {
  props: ["isAlumni", "desserts", "headers"],
  data: () => ({
    dialog: false,
    dialogDelete: false,
    search: "",
    selectedItem: false,
    editedIndex: -1,
    editedItem: {
      first_name: "",
      last_name: "",
      email: "",
    },
    defaultItem: {
      first_name: "",
      last_name: "",
      email: "",
    },
    users: [],
    userId: "",
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  methods: {
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.userId = item.id;
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
      axios.delete('/users/' + this.userId).then(()=>{})
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },

    selectItem(item) {
      this.selectedItem = item;
    },
    unSelectItem() {
      this.selectedItem = false;
    },
  },
  mounted() {},
};
</script>
<style scoped>
</style>