<template>
    <form @submit.prevent="submit">
        <jet-section>
            <template #title>
                Informations principales
            </template>

            <template #description>
                Les premières informations visibles des clients depuis leur page d'accueil
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="title" value="Titre" />
                    <jet-input id="title" type="text" class="mt-1 block w-full" v-model="activity.title" autocomplete="title" />
                    <jet-input-error :message="activity.error('title')" class="mt-2" />
                </div>
            </template>
        </jet-section>
    </form>
</template>

<script>
import JetSection from './../../Jetstream/Section'
import JetLabel from "../../Jetstream/Label";
import JetInput from "../../Jetstream/Input";
import JetInputError from "../../Jetstream/InputError";
import { latLng, Icon } from "leaflet";
import { LMap, LMarker, LTileLayer } from 'vue2-leaflet';
import VueMultiSelect from 'vue-multiselect'
import VueNumberInput from '@chenfengyuan/vue-number-input';
export default {
    components: {
        JetSection,
        JetLabel,
        JetInput,
        JetInputError
    },

    data () {
        return {
            animals: {
                'chien': 'Chien',
                'chat': 'Chat'
            },
            activity: this.$inertia.form({
                title: '',
                category_id: null,
                accepted: [],
                beginning: '',
                ending: '',
                walk_category: '',
                latitude: '',
                longitude: '',
                initial_slots: 0,
                price_cat: '',
                price_dog: '',
                whole_day: false,
                public: null
            }),
            formSettings: {
                map_center: latLng(45.17200129430783, 5.726623535156251),
                map_url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                map_attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                markers: [],
                show_animals: false,
                subcategories: null,
                multiple: false,
                date_label: "Date de début",
                is_walk: false,
                whole_day_text: "L'évènement durera-t-il toute la journée ?"

            },
            errors: []
        }
    },

    methods: {
        submit () {

        }
    }
}
</script>
