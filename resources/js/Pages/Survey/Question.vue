<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
    questions: Object;
}>();
</script>

<template>
    <Head title="Questions" />
    <AuthenticatedLayout>
        <template #header>
            <h1>test</h1>
            <div class="flex flex-col">
                <div class="flex justify-center">
                    <ul class="w-full">
                        <li
                            v-for="question in questions.data"
                            :key="question.id"
                        >
                            <input
                                v-model="question.question"
                                class="mb-2 w-full"
                            />
                        </li>
                    </ul>
                </div>
                <div>
                    <button class="text-white text-xl">Save changes</button>
                </div>
            </div>
            <pre class="text-white">{{
                JSON.stringify(questions, null, 2)
            }}</pre>
        </template>
    </AuthenticatedLayout>
</template>
