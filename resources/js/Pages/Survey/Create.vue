<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Create survey" />
    <AuthenticatedLayout>
        <template #header>
            <div>
                <h1 class="text-white">Create survey</h1>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
