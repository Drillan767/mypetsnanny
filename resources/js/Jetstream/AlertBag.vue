<template>
    <div :class="classes" class="my-6 border-l-4 p-4" role="alert">
        <p class="font-bold">{{ title }}</p>
        <p>{{ message }}</p>
    </div>
</template>

<script>
    export default {
        props: ['type', 'title', 'message'],

        data() {
            return {
                importance: {
                    error: 'red',
                    warning: 'orange',
                    info: 'blue',
                    success: 'green',
                },
                classes: '',
            }
        },

        mounted() {
            this.classes = this.setColors(this.type, this.importance);
        },

        methods: {
            setColors (type, importance) {
                let response = '';
                response += 'bg-' + importance[type] + '-100 ';
                response += 'text-' + importance[type] + '-500 ';
                response += 'border-' + importance[type] + '-700 ';

                return response;
            }
        }

    }
</script>
