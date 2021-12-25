<template>
<v-hover v-slot="{ hover }">
    <v-card
        class="order-3 pa-2 mx-auto mt-5 rounded-lg d-flex "
        outlined
        tile
        width="93%"
        v-for="employment of currentEmpolyment"
        :key="employment.id"
        >
            <v-list class="d-flex" width="95%">
                <v-img src="https://www.zerobhs.com/public/uploads/company/all-other-images/logo/default-logo.png" width="90"></v-img>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-title>Company</v-list-item-title>
                        <v-list-item-subtitle class="mt-2">{{ employment.companyName }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-title>Position</v-list-item-title>
                        <v-list-item-subtitle class="mt-2">{{ employment.position }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item two-line>
                    <v-list-item-content>
                        <v-list-item-title>Years</v-list-item-title>
                        <v-list-item-subtitle class="mt-2">{{ employment.year }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-icon v-if="hover" @click="dialog = !dialog">mdi-pen</v-icon>
            <v-dialog
            v-model="dialog"
            max-width="500px"
            >
            <v-card>
            <v-card-text>
            <v-text-field label="File name"></v-text-field>

            <small class="grey--text">* This doesn't actually save.</small>
            </v-card-text>

            <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
            text
            color="primary"
            @click="dialog = false"
            >
            Submit
            </v-btn>
            </v-card-actions>
            </v-card>
            </v-dialog>
        </v-card>
</v-hover>
</template>

<script>
export default ({
    props:['currentEmpolyment'],
    data() {
    return{
        dialog:false,
    }
},
methods:{
    
},
})
</script>