<template>
    <slide-over :title="'Coucou les enfants'" :is-opened="isOpened" @close-slide="closeSlide">
        <template #slide-over>
            <Form :category="categoryForm" ref="categoryForm" :editing="true" @submit-edit="submit" @close-slide="closeSlide" />
        </template>
    </slide-over>
</template>

<script>
import SlideOver from "../../Jetstream/SlideOver";
import Form from "./Form";
export default {
    props: ['category', 'isOpened'],

    components: {
        SlideOver,
        Form
    },

    data () {
        return {
            categoryForm: this.$inertia.form({
                title: '',
                description: '',
                color: '',
                icon: '',
                whole_day: false,
            }),
        }
    },

    methods: {
        closeSlide () {
            this.$emit('close-edit')
        },

        submit () {
            const childForm = this.$refs.categoryForm;

            this.categoryForm.icon = childForm.$refs.icon.files[0];
            this.categoryForm.color = childForm.color.hex === undefined ? this.categoryForm.color : childForm.color.hex;

            this.categoryForm.post('/admin/category/update', {
                    preserveScroll: true
                }
            )
            .then(() => {
                if (! this.categoryForm.hasErrors()) {
                    this.closeSlide()
                }
            })
        }
    },

    watch: {
        category: function (newVal, oldVal) {
            this.categoryForm = this.$inertia.form({
                ...newVal
            })

        }
    },
}
</script>
