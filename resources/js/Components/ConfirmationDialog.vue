<script setup lang="ts">
const props = defineProps<{
    visible: boolean;
    message: string;
}>();

const emits = defineEmits(["confirm", "cancel"]);

const confirm = () => {
    emits("confirm");
};

const cancel = () => {
    emits("cancel");
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center" v-if="visible">
        <div class="bg-white p-6 rounded shadow-lg">
            <p class="text-lg mb-4">{{ message }}</p>
            <div class="flex justify-end">
                <button @click="confirm" class="bg-red-500">Confirm</button>
                <button @click="cancel" class="bg-black-500">Cancel</button>
            </div>
        </div>
    </div>
</template>
