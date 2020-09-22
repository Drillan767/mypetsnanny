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

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="title" value="Catégorie" />
                    <div class="mt-2">
                        <div v-for="(category, key) in $page.categories" :key="key">
                            <label class="inline-flex items-center">
                                <input
                                    type="radio"
                                    class="form-radio"
                                    :value="category.id"
                                    v-model="activity.category_id"
                                    @click="updateForm"
                                >
                                <span class="ml-2">{{ category.title }}</span>
                            </label>
                        </div>
                        <jet-input-error :message="activity.error('category_id')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4" v-if="formSettings.is_walk">
                    <jet-label for="title" value="Sélectionner une sous-catégorie" />
                    <div class="mt-2">
                        <div v-for="(walk, key) in subcategories" :key="key">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" :id="walk.id" :value="walk.id" v-model="activity.walk_category">
                                <span class="ml-2">{{ walk.title }}</span>
                            </label>
                        </div>
                        <jet-input-error :message="activity.error('walk_category')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4" v-if="formSettings.show_animals">
                    <div>
                        <jet-label for="title" value="Animaux acceptés" />
                    </div>

                    <vue-multi-select
                        placeholder="Sélectionner un animal"
                        :options="animals"
                        name="accepted"
                        label="name"
                        track-by="name"
                        v-model="activity.accepted"
                        :multiple="formSettings.multiple"
                    ></vue-multi-select>
                    <jet-input-error :message="activity.error('accepted')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <div>
                        <jet-label for="title" :value="whole_day ? 'Date' : 'Date de début'" />
                    </div>
                    <Datetime
                        v-model="activity.beginning"
                        type="datetime"
                        input-class="form-input rounded-md shadow-sm mt-1 block w-full"
                    />
                    <jet-input-error :message="activity.error('beginning')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4" v-if="!whole_day">
                    <div>
                        <jet-label for="title" value="Date de fin" />
                    </div>
                    <Datetime
                        v-model="activity.ending"
                        type="datetime"
                        input-class="form-input rounded-md shadow-sm mt-1 block w-full"
                    />
                    <jet-input-error :message="activity.error('ending')" class="mt-2" />
                </div>

            </template>
        </jet-section>

        <jet-section-border />

        <jet-section>
            <template #title>
                Localisation
            </template>

            <template #description>
                Indiquez où se déroulera la prestation
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <l-map
                        style="height: 400px; width: 100%"
                        :center="formSettings.map_center"
                        @click="addMarker"
                        :zoom="12"
                    >
                        <l-tile-layer
                            :url="formSettings.map_url"
                            :attributions="formSettings.map_attribution"
                        />
                        <l-marker v-for="(marker, index) in formSettings.markers" :lat-lng="marker" :key="index"/>
                    </l-map>
                </div>
            </template>
        </jet-section>

        <jet-section-border />

        <jet-section>
            <template #title>
                Informations complémentaires
            </template>

            <template #description>
                Définissez les dernières informations nécessaires pour la prestation.
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <div>
                        <jet-label for="title" value="places disponibles" />
                    </div>

                    <VueNumberInput
                        v-model="activity.initial_slots"
                        :min="1"
                        :max="10"
                        inline
                        center
                        controls
                    />
                </div>

                <div class="col-span-6 sm:col-span-4 flex justify-between">
                    <div v-if="accepted.includes('chien')">
                        <jet-label for="price_dog" value="Tarif pour un chien" />
                        <jet-input
                            id="price_dog"
                            placeholder="exemple: 12.34"
                            type="text"
                            class="mt-1
                            block w-full"
                            v-model="activity.price_dog"
                            autocomplete="price_dog"
                        />
                        <jet-input-error :message="activity.error('price_dog')" class="mt-2" />
                    </div>
                    <div v-if="accepted.includes('chat')">
                        <jet-label for="price_cat" value="Tarif pour un chat" />
                        <jet-input
                            id="price_cat"
                            placeholder="exemple: 12.34"
                            type="text"
                            class="mt-1
                            block w-full"
                            v-model="activity.price_cat"
                            autocomplete="price_dog"
                        />
                        <jet-input-error :message="activity.error('price_cat')" class="mt-2" />
                    </div>
                </div>
            </template>
        </jet-section>
        <div class="flex justify-end py-12" >

            <button
                @click="publish(false)"
                type="button"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
            >
                Enregistrer comme brouillon
            </button>

            <button
                @click="publish(true)"
                type="button"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
            >
                Enregistrer et publier
            </button>
        </div>
    </form>
</template>

<script>
import JetSection from './../../Jetstream/Section'
import JetLabel from "../../Jetstream/Label";
import JetInput from "../../Jetstream/Input";
import JetInputError from "../../Jetstream/InputError";
import JetButton from './../../Jetstream/Button';
import JetSecondaryButton from './../../Jetstream/SecondaryButton';
import JetSectionBorder from './../../Jetstream/SectionBorder'
import { latLng, Icon } from "leaflet";
import { LMap, LMarker, LTileLayer } from 'vue2-leaflet';
import VueMultiSelect from 'vue-multiselect'
import VueNumberInput from '@chenfengyuan/vue-number-input';
import { Datetime } from 'vue-datetime';
import 'leaflet/dist/leaflet.css';
export default {
    components: {
        JetSection,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetSecondaryButton,
        JetSectionBorder,
        VueMultiSelect,
        Datetime,
        LMap,
        LMarker,
        LTileLayer,
        VueNumberInput,
    },

    data () {
        return {
            animals: [
                {id: 'chien', name: 'Chien'},
                {id: 'chat', name: 'Chat'}
            ],
            subcategories: [
                {id: 'rando', title: 'Randonnée'},
                {id: 'balade_matin', title:'Balade du matin'},
                {id: 'balade_soir', title:'Balade du soir'}
            ],
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
                multiple: false,
                date_label: "Date de début",
                is_walk: false,
                whole_day_text: "L'évènement durera-t-il toute la journée ?"

            },
            errors: []
        }
    },

    mounted() {
        delete Icon.Default.prototype._getIconUrl;
        Icon.Default.mergeOptions({
            iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
            iconUrl: require('leaflet/dist/images/marker-icon.png'),
            shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
        });
    },

    methods: {

        publish (value) {
            console.log('public: ', value);
            this.activity.public = value;
            this.submit();
        },

        submit () {
            this.activity.post('/admin/prestation/add')
        },

        /**
         * Si balade est cliqué :
         * - Afficher les sous-catégories de balade
         * - Ajouter "chien" dans this.accepted
         *
         * Si pension est cliqué :
         * - Afficher les animaux | select simple
         *
         * Si visite est cliqué :
         * - Afficher les animaux | select multiple
         *
         * @param e
         */
        updateForm (e) {
            // Reset values
            this.formSettings.is_walk = false;
            this.formSettings.show_animals = false;
            this.formSettings.multiple = true;

            // We need to SLIGHTLY delay the check on this.selected,
            // otherwise we'll work with the old data while the new is updating.
            setTimeout(() => {

                switch (this.selected.slug) {
                    case 'balade':
                        this.formSettings.is_walk = true;
                        this.activity.accepted = [{id: 'chien', name: 'Chien'}];
                        break;
                    case 'pension':
                        this.formSettings.show_animals = true;
                        this.formSettings.multiple = false;
                        this.activity.walk_category = '';
                        break;
                    case 'visite':
                        this.formSettings.show_animals = true;
                        this.activity.walk_category = '';
                }
            }, 50)
        },

        addMarker (e) {
            this.formSettings.markers = [];
            this.formSettings.markers.push(e.latlng)
            this.activity.latitude = e.latlng.lat
            this.activity.longitude = e.latlng.lng
        }
    },

    computed: {
        selected () {
            if (this.activity.category_id) {
                return this.$page.categories.find(c => c.id === this.activity.category_id)
            } else {
                return {};
            }
        },

        whole_day () {
            if(this.activity.category_id === null && this.activity.walk_category === '') {
                return false
            } else {
                return this.$page.categories.find(c => c.id === this.activity.category_id).whole_day || this.activity.walk_category === 'rando';
            }
        },

        accepted () {
            let animals = [];
            ['chat', 'chien'].forEach((animal) => {
                if (Array.isArray(this.activity.accepted) && this.activity.accepted.find(a => a.id === animal)) {
                    animals.push(animal)
                } else {
                    if (this.activity.accepted.id === animal) {
                        animals.push(animal)
                    }
                }
            });

            return animals;
        }
    },
}
</script>
