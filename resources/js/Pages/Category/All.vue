<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <slide-over :title="'Coucou les enfants'" :is-opened="slideOpen" @close-slide="closeSlide">
            <template #slide-over>
                <h1>Bonjour ceci est un contenu de type standard</h1>
            </template>
        </slide-over>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <jet-button @click.native="displayCategoryModal">
                            Nouvelle catégorie
                        </jet-button>
                    </div>
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/icon-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                Jane Cooper
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                jane.cooper@example.com
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">Regional Paradigm Technician</div>
                                    <div class="text-sm leading-5 text-gray-500">Optimization</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                      Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    Admin
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <span @click.prevent="edit" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Edit</span>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="createCategory" @close="createCategory = false">
            <template #title>
                Nouvelle catégorie
            </template>

            <template #content>

                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Titre"
                               ref="title"
                               v-model="newCategory.title"
                    />

                    <jet-input-error :message="newCategory.error('title')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <jet-textarea :placeholder="'description'" v-model="newCategory.description"></jet-textarea>

                    <jet-input-error :message="newCategory.error('title')" class="mt-2" />
                </div>

                <div class="mt-4 col-span-6 sm:col-span-4">
                    <!-- Category Icon File Input -->
                    <input type="file" class="hidden"
                           ref="icon"
                           @change="updateIconPreview">

                    <jet-label for="icon" value="Image" />

                    <!-- New Profile Icon Preview -->
                    <div class="mt-2" v-show="iconPreview">
                        <span class="block rounded-full w-20 h-20"
                              :style="'background-size: cover; background-repeat: no-repeat; background-position: center; background-image: url(\'' + iconPreview + '\');'">
                        </span>
                    </div>

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewIcon">
                        Sélectionnez une nouvelle image
                    </jet-secondary-button>

                    <jet-input-error :message="newCategory.error('icon')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="color" value="Couleur" />
                    <slider id="color" v-model="color" />
                </div>

                <div class="mt-4">
                    <label class="inline-flex items-center mt-3">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" v-model="newCategory.whole_day" :checked="newCategory.whole_day">
                        <span class="ml-2 text-gray-700">La prestation dure-t-elle toute la journée ?</span>
                    </label>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="createCategory = false">
                    Annuler
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="submitCategory" :class="{ 'opacity-25': newCategory.processing }" :disabled="newCategory.processing">
                    Enregistrer
                </jet-button>
            </template>
        </jet-dialog-modal>

    </admin-layout>
</template>

<script>
import Slider from 'vue-color/src/components/Slider.vue';
import AdminLayout from "../../Layouts/AdminLayout";
import SlideOver from "../../Jetstream/SlideOver";
import JetButton from './../../Jetstream/Button';
import JetLabel from './../../Jetstream/Label';
import JetDialogModal from './../../Jetstream/DialogModal';
import JetSecondaryButton from './../../Jetstream/SecondaryButton';
import JetInput from './../../Jetstream/Input';
import JetTextarea from './../../Jetstream/Textarea';
import JetInputError from './../../Jetstream/InputError';

export default {
    props: ['categories'],
    components: {
        JetButton,
        JetInput,
        JetLabel,
        JetTextarea,
        JetInputError,
        JetDialogModal,
        JetSecondaryButton,
        SlideOver,
        AdminLayout,
        'Slider': Slider
    },

    data () {
        return {
            slideOpen: false,
            createCategory: false,
            iconPreview: null,
            color: '',
            newCategory: this.$inertia.form({
                '_method': 'POST',
                title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,
            })
        }
    },

    methods: {
        edit () {
            this.slideOpen = !this.slideOpen;
        },

        closeSlide (e) {
            this.slideOpen = e;
        },

        displayCategoryModal () {
            this.newCategory.title = '';
            this.newCategory.description = '';
            this.newCategory.color = '';
            this.newCategory.icon = '';
            this.createCategory = true;

            setTimeout(() => {
                this.$refs.title.focus()
            }, 250)
        },

        updateIconPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.iconPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.icon.files[0]);
        },

        selectNewIcon() {
            this.$refs.icon.click();
        },

        submitCategory() {
            this.newCategory.color = this.color.hex;
            this.newCategory.icon = this.$refs.icon.files[0]
            this.newCategory.post('/admin/category/add', {
                preserveScroll: true
            }).then(response => {
                if (! this.newCategory.hasErrors()) {
                    this.createCategory = false;
                }
            })
        },
    }
}
</script>
