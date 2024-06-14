<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
    surveys: Object;
}>();
</script>

<template>
    <Head title="Surveys" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl">Surveyyss</h2>
            <pre class="text-white">{{ JSON.stringify(surveys, null, 2) }}</pre>
        </template>
    </AuthenticatedLayout>
</template>
