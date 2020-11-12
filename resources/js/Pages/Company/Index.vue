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
                    <h3 class="text-bold">
                        <span :class="'text-xs font-bold inline-block py-1 px-3 uppercase rounded text-'+company.company_type.color+'-600 bg-'+company.company_type.color+'-200 uppercase last:mr-0 mr-0'">
                            {{ company.company_type.name }}
                        </span>
                        - {{ company.name }}
                    </h3>

                </div>
                <div>
                    <button class="teal white--text text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                        EDIT
                    </button>
                    <button class="pink white--text font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
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
                <a :href="'company/'+ company.id" class="shadow bg-blue-400 white--text px-2 py-1 text-sm rounded mt-3 hover:bg-blue-600 inline-block">More details</a>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

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
