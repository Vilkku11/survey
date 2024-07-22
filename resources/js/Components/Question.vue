<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
defineProps<{
    question: string;
    type: number;
    editMode: boolean;
}>();

const test = "test";
</script>

<template>
    <div v-if="editMode">
        <div v-if="type === 1">
            <TextInput type="text" v-model="test" />
        </div>
    </div>
    <div v-else>
        <div v-if="type === 1">
            <h2>{{ question }}</h2>
            <p>Answer</p>
        </div>
    </div>
</template>
