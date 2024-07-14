<script setup lang="ts">
type FlashProps = {
    success?: string;
    error?: string;
};

const props = defineProps<{ flash: FlashProps }>();
</script>

<template>
    <div
        v-if="props.flash.success || props.flash.error"
        :class="[
            'mb-4 px-4 py-2 text-white rounded shadow transition-all font-bold',
            {
                'bg-emerald-500': props.flash.success,
                'bg-red-500': props.flash.error,
            },
        ]"
    >
        {{ props.flash.success || props.flash.error }}
    </div>
</template>
