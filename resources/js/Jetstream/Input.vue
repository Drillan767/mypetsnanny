<template>
    <input class="form-input rounded-md shadow-sm" :placeholder="placeholder" :value="value" @input="$emit('input', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['value', 'placeholder'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

