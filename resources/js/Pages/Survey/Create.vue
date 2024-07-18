<script setup lang="ts">
import InputLabel from "@/Components/InputLabel.vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    title: "",
    description: "",
});

const onSubmit = () => {
    form.post("/surveys");
};

const cancel = () => {
    router.get("/surveys");
};
</script>

<template>
    <Head title="Create survey" />
    <AuthenticatedLayout>
        <template #header>
            <div>
                <h1 class="text-white">Create survey</h1>
                <form @submit.prevent="onSubmit">
                    <InputLabel value="title" />
                    <TextInput type="text" v-model="form.title" />
                    <InputLabel value="description" />
                    <TextInput type="text" v-model="form.description" />
                    <InputError :message="form.errors.title" />
                    <InputError :message="form.errors.description" />
                    <div class="mt-4 text-right">
                        <button
                            type="button"
                            @click="cancel"
                            class="mb-0 px-2 py-1 bg-red-500 text-white rounded shadow transition-all hover:bg-red-600 font-bold"
                        >
                            Cancel
                        </button>
                        <button
                            class="mb-0 px-2 py-1 bg-emerald-500 text-white rounded shadow transition-all hover:bg-emerald-600 font-bold"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
