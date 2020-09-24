<template>
    <jet-dialog-modal :show="show" @close="close">
        <template #title>
            Supprimer "{{ form.title }}" ?
        </template>

        <template #content>
            <p>
                Vous vous apprétez à supprimer la catégorie "{{ form.title }}". <br />
                Cette action est irréversible, et toutes les prestations liées seront également supprimées. Continuer ?
            </p>
        </template>

        <template #footer>
            <jet-secondary-button @click.native="close">
                Annuler
            </jet-secondary-button>

            <jet-danger-button class="ml-2" @click.native="deleteCategory">
                Supprimer
            </jet-danger-button>
        </template>
    </jet-dialog-modal>
</template>

<script>
import JetDialogModal from './../../Jetstream/DialogModal';
import JetDangerButton from './../../Jetstream/DangerButton';
import JetSecondaryButton from './../../Jetstream/SecondaryButton';

export default {
    props: ['category', 'show'],

    data () {
        return {
            form: this.$inertia.form({
                title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,
            }),
        }
    },

    components: {
        JetDialogModal,
        JetDangerButton,
        JetSecondaryButton,
    },

    methods: {
        deleteCategory () {
            this.form.post('/admin/category/delete/' + this.form.id)
            .then(() => this.close())
        },

        close () {
            this.$emit('close-delete');
        }
    },

    watch: {
        category: function (newVal, oldVal) {
            this.form = this.$inertia.form({
                ...newVal
            })

        }
    }
}
</script>
