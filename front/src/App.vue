<template>
  <v-app>
    <navagation></navagation>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import Navagation from "./components/nav/Navagation.vue";


export default {
  name: 'App',
  components: {
    Navagation
  },
};
</script>
