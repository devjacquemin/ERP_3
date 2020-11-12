<template>
<v-app>
    <app-layout>
        <template #header>
            <div class="font-semibold text-xl text-gray-800 leading-tight">
                List of companies
            </div>
        </template>
        <div class="py-6">
            <div class="bg-white rounded p-6 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="text-sm">

                    <ul v-for="Ftype in this.typeList" v-bind:key="Ftype.id">
                        <li class="mt-1">
                            <span class="ma-2 v-chip v-chip--label v-chip--no-color v-size--small success">{{ Ftype.name }}</span>
                        </li>
                        <span class="v-chip v-chip--label theme--light v-size--default white--text text--lighten-2 light-green"><span class="v-chip__content">Developer</span></span>
                    </ul>
                </div>
            </div>
        </div>
    </app-layout>
</v-app>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },

    props: ['Ftype'],
    data() {
        return {
            typeList: this.Ftype
        }
    },

    computed: {
        headers() {
            return [{
                text: 'test',
                value: 'valeur'
            }]
        }
    },

    mounted() {
        console.log(this.typeList);
    }
}
</script>

<style>
@import "vuetify/dist/vuetify.min.css";
</style>
