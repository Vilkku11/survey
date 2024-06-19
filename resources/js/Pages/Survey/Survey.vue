<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps<{
    surveys: Object;
}>();
function loadQuestions(surveyId: number) {
    router.get(`/surveys/${surveyId}/questions`);
}
</script>

<template>
    <Head title="Surveys" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl mb-4 text-white">Surveyys</h2>

            <div>
                <div class="w-full flex justify-end">
                    <Link
                        class="mb-2 px-2 py-1 bg-emerald-500 text-white rounded shadow transition-all hover:bg-emerald-600 font-bold"
                        href="/survey/create"
                        >New survey</Link
                    >
                </div>

                <ul>
                    <li v-for="survey in surveys.data" :key="survey.id">
                        <button
                            @click="loadQuestions(survey.id)"
                            class="mt2 mb-2 border border-white hover:border-2"
                        >
                            <div class="text-white text-xl">
                                {{ survey.title }}
                            </div>
                            <div>
                                {{ survey.description }}
                            </div>
                            <div class="flex justify-end">
                                <p class="mr-2">
                                    last modified: {{ survey.modified_at }}
                                </p>
                            </div>
                        </button>
                    </li>
                </ul>
            </div>
            <pre class="text-white">{{ JSON.stringify(surveys, null, 2) }}</pre>
        </template>
    </AuthenticatedLayout>
</template>
