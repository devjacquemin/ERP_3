<template>
<app-layout>
    <template #header>
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            List of companies
        </div>
    </template>
    <div class="py-6" v-for="company in this.companyList" v-bind:key="company.id">
        <div class="bg-white rounded p-6 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex justify-between items-center mb-2">
                <div>
                    <span :class="'text-xs font-bold inline-block py-1 px-3 uppercase rounded-full text-'+company.company_type.color+'-600 bg-'+company.company_type.color+'-200 uppercase last:mr-0 mr-0'">
                        {{ company.company_type.name }}
                    </span>
                    <a class="">- {{ company.name }}</a>
                </div>
                <div>
                    <button class="bg-teal-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                        EDIT
                    </button>
                    <button class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                        X
                    </button>
                </div>
            </div>

            <hr class="py-2">

            <div class="text-sm"><b>Contact:</b> {{ company.user.name }}</div>
            <div class="text-sm"><b>Cellphone:</b> +33625865452</div>
            <div class="text-sm"><b>Number of products:</b> {{ company.products_count }}</div>
            <div class="text-sm"><b>Address:</b> {{ company.address }}</div>
            <div class="text-sm"><b>Mail:</b> {{ company.mail }}</div>

            <div class="items-right">
                <a :href="'company/'+ company.id" class="shadow bg-blue-400 text-white px-2 py-1 text-sm rounded mt-3 hover:bg-blue-600 inline-block">More details</a>
                <a href="" class="shadow bg-green-400 text-white px-2 py-1 text-sm rounded mt-3 hover:bg-green-600 inline-block">Stocks</a>
                <a href="" class="shadow bg-orange-400 text-white px-2 py-1 text-sm rounded mt-3 hover:bg-orange-500 inline-block">Analytics</a>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },

    props: ['company'],

    data() {
        return {
            companyList: this.company
        }
    },

    mounted() {
        console.dir(this.companyList);
    }
}
</script>

<style>
@import "vuetify/dist/vuetify.min.css";
</style>
