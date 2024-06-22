<script setup lang="ts">
import InputLabel from "@/Components/InputLabel.vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";

function onSubmit() {}

useForm({
    title: "",
    description: "",
});
</script>

<template>
    <Head title="Create survey" />
    <AuthenticatedLayout>
        <template #header>
            <div>
                <h1 class="text-white">Create survey</h1>
                <form :on-submit="onSubmit">
                    <InputLabel value="Title" />
                    <TextInput />
                    <InputLabel value="Description" />
                    <TextInput />
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
