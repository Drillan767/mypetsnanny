<template>
    <textarea class="form-input rounded-md shadow-sm mt-1 block w-3/4" :placeholder="placeholder" :value="value" @input="$emit('input', $event.target.value)" ref="input"></textarea>
</template>

<script>
export default {
    props: ['value', 'placeholder'],
}
</script>

