<template>
    <textarea
        class="form-input rounded-md shadow-sm mt-1 block w-full"
        :placeholder="placeholder"
        :value="value"
        rows="5"
        @input="$emit('input', $event.target.value)"
        ref="input"
    ></textarea>
</template>

<script>
export default {
    props: ['value', 'placeholder'],
}
</script>

