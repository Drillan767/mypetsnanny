<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Prestations
            </h2>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <jet-link :href="'/admin/prestation/creer-prestation'">
                                    Nouvelle prestation
                                </jet-link>
                            </div>

                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <vue-good-table
                                    :columns="columns"
                                    :rows="$page.activities"
                                    :fixed-header="true"
                                    :search-options="{
                                        enabled: true,
                                        trigger: 'enter',
                                        placeholder: 'Rechercher',
                                    }"
                                >
                                    <template slot="table-row" slot-scope="props">
                                        <div v-if="props.column.field === 'actions'" class="flex justify-end">
                                           <inertia-link :href="`/admin/prestation/editer-prestation/${props.row.id}`">
                                                Editer
                                           </inertia-link>
                                            <span class="ml-2">|</span>
                                            <span class="cursor-pointer ml-2" @click="displayDelete(props.row)">
                                                Supprimer
                                            </span>
                                        </div>
                                        <div v-else-if="props.column.field === 'remaining_slots'">
                                            <p>{{ props.row.remaining_slots }} / {{ props.row.initial_slots }}</p>
                                        </div>
                                        <div v-else-if="props.column.field === 'beginning'">
                                            <span v-if="props.row.category.whole_day || props.row.walk_category === 'rando'">
                                                {{ readableDate(props.row.beginning) }}
                                            </span>
                                                                        <span v-else>
                                                {{ readableDate2(props.row.beginning, props.row.ending) }}
                                            </span>
                                        </div>
                                        <div v-else-if="props.column.field === 'price_dog'">
                                            <p class="mb-0">
                                                <span v-if="props.row.price_dog"><b>Chien : </b> {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(props.row.price_dog) }}</span>
                                                <span v-if="props.row.price_cat"><b>Chat : </b> {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(props.row.price_cat) }}</span>
                                            </p>
                                        </div>
                                        <div v-else>
                                            {{props.formattedRow[props.column.field]}}
                                        </div>
                                    </template>
                                    <div slot="emptystate">
                                        Aucun résultat
                                    </div>
                                </vue-good-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Delete :activity="activity" :show="deleteActivity" @close-delete="closeDelete" />

    </admin-layout>
</template>

<script>
import AdminLayout from "../../Layouts/AdminLayout";
import JetLink from "../../Jetstream/Link";
import { VueGoodTable } from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
import dayjs from 'dayjs';
import Delete from "./Delete";

export default {
    components: {
        Delete,
        AdminLayout,
        JetLink,
        VueGoodTable,
    },

    data () {
        return {
            deleteActivity: false,
            activity: null,
            columns: [
                {
                    label: 'Titre',
                    field: 'title',
                    filterable: true
                },
                {
                    label: 'Catégorie',
                    field: this.categoryFn
                },
                {
                    label: 'Places restantes',
                    field: 'remaining_slots',
                    width: '110px',
                },
                {
                    label: 'Date de la prestation',
                    field: 'beginning'
                },
                {
                    label: 'Prix',
                    field: 'price_dog'
                },
                {
                    label: 'Date de création',
                    field: 'created_at',
                    type: 'date',
                    formatFn: this.createdFn
                },
                {
                    label: 'Actions',
                    field: 'actions'
                },
            ]
        }
    },

    methods: {
        categoryFn (rowObj) {
            if (rowObj.category.title === 'Balade') {
                return rowObj.category.title + ' / ' + rowObj.walk_category
            } else {
                return rowObj.category.title
            }
        },

        readableDate (value) {
            return dayjs(value).format('DD/MM/YYYY')
        },

        readableDate2 (value1, value2) {
            let response = ''; // →
            response += dayjs(value1).format('DD/MM/YYYY') + ' (';
            response += dayjs(value1).format('HH:mm') + ' → ';
            response += dayjs(value2).format('HH:mm') + ')';
            return response
        },

        createdFn (value) {
            return dayjs(value).format('DD/MM/YYYY')
        },

        displayDelete (activity) {
            this.deleteActivity = true;
            this.activity = activity;
        },

        closeDelete () {
            this.deleteActivity = false;
        }
    }
}
</script>

<style>
.vgt-fixed-header {
    z-index: 0;
}
</style>
