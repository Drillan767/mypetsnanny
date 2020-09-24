<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nouvelle prestation
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Form :activity="activity" :updating="false" @submit="submit" />
        </div>
    </admin-layout>

</template>

<script>
import Form from './Form'
import AdminLayout from "../../Layouts/AdminLayout";
export default {
    components: {
        Form,
        AdminLayout,
    },

    data () {
        return {
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
        }
    },

    methods: {
        submit () {
            this.activity.post('/admin/prestation/add')
            .then(() => console.log(this.activity.errors));
        }
    }
}
</script>
