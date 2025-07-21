<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block font-medium text-lg text-nowrap text-ellipsis text-gray-700 dark:text-gray-300 px-2 py-1">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
