<script setup lang="ts">
const props = defineProps<{
    question: string;
}>();

const emit = defineEmits(["update:question"]);

const updateQuestion = (value: string) => {
    console.log("firing");
    emit("update:question", value);
};
</script>

<template>
    <input
        class="mb-2 w-full"
        :value="question"
        @input="updateQuestion($event.target.value)"
    />
</template>
