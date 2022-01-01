<template>
        
  <v-card elevation="2" color="#EEEEEE" class="d-flex align-center pa-0 ma-0"  style="height:45px" >
      <v-text-field
        dense
        hide-details
        flat solo
        append-icon="mdi-magnify"
        placeholder = "Search"
        v-model="search"
        background-color="#EEEEEE"
      ></v-text-field>
  </v-card>
</template>
<script>
export default {
    emits:['searchValue'],
    data() {
        return {
           search:"",
        }
    },
    watch:{
        search(value){
            this.$emit("searchValue",value);

        }
    }
}
</script>
<style scoped>

</style>