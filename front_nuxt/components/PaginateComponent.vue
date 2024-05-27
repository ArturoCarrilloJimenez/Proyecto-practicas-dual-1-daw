<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    activeNext: {
        type: Boolean,
        default: true
    },
    activeBack: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['next', 'back']);
</script>

<template>
    <div class="btn-group mt-5">
        <button class="px-4 py-2 rounded mr-4"
            :class="['bg-blue-900 text-white hover:bg-blue-700', { 'bg-blue-400 text-gray-300 cursor-not-allowed': props.activeBack }]"
            @click="emit('back')" :disabled="props.activeBack">
            << </button>
                <button class="px-4 py-2 rounded"
                    :class="['bg-blue-900 text-white hover:bg-blue-700', { 'bg-blue-400 text-gray-300 cursor-not-allowed': props.activeNext }]"
                    @click="emit('next')" :disabled="props.activeNext"> >>
                </button>
    </div>

</template>
