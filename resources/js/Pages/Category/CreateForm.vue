<template>
    <jet-dialog-modal :show="show" @close="close">
        <template #title>
            Nouvelle catégorie
        </template>

        <template #content>
            <CategoryForm ref="categoryForm" :category="category" :editing="false" />
        </template>

        <template #footer>
            <jet-secondary-button @click.native="close">
                Annuler
            </jet-secondary-button>

            <jet-button class="ml-2" @click.native="submitCategory" :class="{ 'opacity-25': category.processing }" :disabled="category.processing">
                Enregistrer
            </jet-button>
        </template>
    </jet-dialog-modal>
</template>

<script>
import CategoryForm from './Form';
import JetDialogModal from './../../Jetstream/DialogModal';
import JetButton from './../../Jetstream/Button';
import JetSecondaryButton from './../../Jetstream/SecondaryButton';

export default {
    props: ['show'],

    components: {
        CategoryForm,
        JetDialogModal,
        JetButton,
        JetSecondaryButton
    },

    data () {
        return {
            iconInput: null,
            category: this.$inertia.form({
                '_method': 'POST',
                title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,
            }),
        }
    },

    methods: {

        close () {
            this.$emit('close');
        },

        submitCategory() {
            const childForm = this.$refs.categoryForm;
            this.category.icon = childForm.$refs.icon.files[0];
            this.category.color = childForm.color.hex;

            this.category.post('/admin/category/add', {
                preserveScroll: true
            }
            ).then(() => {
                if (! this.category.hasErrors()) {
                    this.createCategory = false;
                }
            })
        },
    }
}
</script>
