<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head } from '@inertiajs/vue3';
</script>


<template>
    <Head title="Edit survey" />
    <AuthenticatedLayout>
        <template #header>
            <div>
                <h1 class="text-black">Edit</h1>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
