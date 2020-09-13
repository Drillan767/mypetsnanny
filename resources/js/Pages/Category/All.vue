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
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
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
                Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                <!--title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,-->
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Titre"
                               ref="title"
                               v-model="newCategory.title"
                    />

                    <jet-input-error :message="newCategory.error('title')" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click.native="createCategory = false">
                    Annuler
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="submitCategory" :class="{ 'opacity-25': newCategory.processing }" :disabled="newCategory.processing">
                    Delete Account
                </jet-button>
            </template>
        </jet-dialog-modal>

    </admin-layout>
</template>

<script>
import AdminLayout from "../../Layouts/AdminLayout";
import SlideOver from "../../Jetstream/SlideOver";
import JetButton from './../../Jetstream/Button';
import JetDialogModal from './../../Jetstream/DialogModal';
import JetSecondaryButton from './../../Jetstream/SecondaryButton'
import JetInput from './../../Jetstream/Input'
import JetInputError from './../../Jetstream/InputError'


export default {
    props: ['categories'],
    components: {
        JetButton,
        JetInput,
        JetInputError,
        JetDialogModal,
        JetSecondaryButton,
        SlideOver,
        AdminLayout
    },

    data () {
        return {
            slideOpen: false,
            createCategory: false,
            newCategory: this.$inertia.form({
                '_method': 'POST',
                title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,
            })

            /*newCategory: this.$inertia.newCategory({
                '_method': 'POST',
                title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,
            }, {
                bag: 'createCategory'
            })*/
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

        submitCategory() {
            this.newCategory.post('/category/add', {
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
