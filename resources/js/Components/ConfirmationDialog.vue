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
    <div
        v-if="visible"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50"
        @click.self="cancel"
    >
        <div class="bg-gray-800 border border-gray-700 p-6 rounded shadow-lg">
            <p class="text-lg text-white mb-4">{{ message }}</p>
            <div class="flex justify-end space-x-4">
                <button
                    @click="confirm"
                    class="mb-2 px-2 py-1 bg-red-500 text-white"
                >
                    Confirm
                </button>
                <button
                    @click="cancel"
                    class="mb-2 px-2 py-1 bg-black-500 text-white"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>
