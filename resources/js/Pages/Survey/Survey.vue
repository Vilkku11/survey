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

            <div>
                <ul>
                    <li v-for="survey in surveys.data" :key="survey.id">
                        <button
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
