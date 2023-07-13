<script setup>
import { Alert } from "flowbite-vue";

defineProps({
    type: {
        type: String,
        default: 'success',
        validator(value) {
            return ['info', 'danger', 'success', 'warning', 'dark'].includes(value);
        },
    },
    message: {
        type: String,
        required: true
    }
})
</script>

<template>
    <div class="flex flex-col">
        <Alert :type="type" closable>{{ message }}</Alert>
    </div>
</template>
