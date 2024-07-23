<script setup lang="ts">
import { ref, watch } from "vue";
import { XMarkIcon } from "@heroicons/vue/16/solid";
type FlashProps = {
    success?: string;
    error?: string;
};

type Errors = {
    description: string;
};

const isOpen = ref<boolean>(true);

const closeAlert = () => {
    isOpen.value = false;
};

const props = defineProps<{ flash: FlashProps; errors: Errors }>();

watch(
    () => [props.flash, props.errors],
    ([flash, errors]) => {
        isOpen.value = true;
    }
);
</script>

<template>
    <div
        v-if="
            (props.flash.success || props.flash.error || props.errors) && isOpen
        "
        :class="[
            'flex items-center justify-between mb-4 px-4 py-2 text-white rounded shadow transition-all font-bold',
            {
                'bg-emerald-500': props.flash.success,
                'bg-red-500': props.flash.error || props.errors,
            },
        ]"
    >
        {{
            props.flash.success || props.flash.error || props.errors.description
        }}
        <button class="hover:bg-white hover:bg-opacity-40" @click="closeAlert">
            <XMarkIcon class="size-5 transition-all" />
        </button>
    </div>
</template>
