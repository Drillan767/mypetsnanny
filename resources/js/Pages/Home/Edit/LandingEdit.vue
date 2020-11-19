<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Éditer la page d'accueil
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Form />
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "../../../Layouts/AdminLayout";
import Form from "./Form";
export default {
    components: {
        AdminLayout,
        Form,
    }
}
</script>
