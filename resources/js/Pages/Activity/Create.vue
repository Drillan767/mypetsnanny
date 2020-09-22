<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nouvelle prestation
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Form />
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
    }
}
</script>
