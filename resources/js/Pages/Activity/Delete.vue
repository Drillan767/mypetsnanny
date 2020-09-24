<template>
    <jet-dialog-modal :show="show" @close="close">
        <template #title>
            Supprimer "{{ form.title }}" ?
        </template>

        <template #content>
            <p>
                Vous vous apprétez à supprimer la prestation "{{ form.title }}". <br />
                Cette action est irréversible. Toutes les personnes inscrites à cette prestation seront remboursées
                et un e-mail leur notifiant de la suppression de cette prestation leur sera envoyé. <br />
                Continuer ?
            </p>
        </template>

        <template #footer>
            <jet-secondary-button @click.native="close">
                Annuler
            </jet-secondary-button>

            <jet-danger-button class="ml-2" @click.native="deleteActivity">
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
    props: ['activity', 'show'],
    components: {
        JetDialogModal,
        JetDangerButton,
        JetSecondaryButton,
    },

    data () {
        return {
            form: this.$inertia.form({
                title: '',
            })
        }
    },

    methods: {
        deleteActivity () {
            this.form.post('/admin/prestation/delete/' + this.form.id)
                .then(() => this.close())
        },

        close () {
            this.$emit('close-delete');
        }
    },

    watch: {
        activity: function (newVal, oldVal) {
            this.form = this.$inertia.form({
                ...newVal
            })

        }
    }
}
</script>
