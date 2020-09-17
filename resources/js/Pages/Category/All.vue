<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <slide-over :title="'Coucou les enfants'" :is-opened="slideOpen" @close-slide="closeSlide">
            <template #slide-over>
<!--                <CategoryForm :category="editedCategory" />-->
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
                                    Image
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Titre
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Durée
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="(category, key) in categories" :key="key">
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 rounded-full border-solid border-4" :style="{ borderColor: category.color }">
                                            <img class="h-10 w-10 rounded-full" :src="category.icon" alt="">
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{ category.title }}</div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ category.description.length > 75 ? category.description.substring(0, 75) + '...' : category.description }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <span v-if="category.whole_day" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                      Toute la journée
                                    </span>
                                    <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Moins d'une journée
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <span @click.prevent="edit(category)" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Modifier</span>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <CreateForm :show="createCategory" />

    </admin-layout>
</template>

<script>
import AdminLayout from "../../Layouts/AdminLayout";
import SlideOver from "../../Jetstream/SlideOver";
import JetButton from './../../Jetstream/Button';
import CreateForm from './CreateForm';

export default {
    props: ['categories'],
    components: {
        CreateForm,
        JetButton,
        SlideOver,
        AdminLayout,
    },

    data () {
        return {
            slideOpen: false,
            createCategory: false,
            editedCategory: null,
        }
    },

    methods: {
        edit (category) {
            this.slideOpen = !this.slideOpen;
            this.editedCategory = category;
        },

        closeSlide (e) {
            this.slideOpen = e;
            this.editedCategory = null;
        },

        displayCategoryModal () {
            this.createCategory = true;
        },
    }
}
</script>
