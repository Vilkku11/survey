<script setup lang="ts">
import { ref } from "vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ConfirmationDialog from "../../Components/ConfirmationDialog.vue";
import AlertBox from "../../Components/AlertBox.vue";

import { XMarkIcon } from "@heroicons/vue/16/solid";

type SurveyList = {
    data: Array<{
        id: number;
        title: string;
        description: string;
        created_at: string;
        modified_at: string;
    }>;
};

const dialogVisibility = ref<boolean>(false);
const selectedSurvey = ref<number | null>(null);

defineProps<{
    surveys: SurveyList;
}>();
const loadSurvey = (surveyId: number) => {
    router.get(`/surveys/${surveyId}`);
};

const deleteSurvey = () => {
    router.delete(`/surveys/${selectedSurvey.value}`, {
        onSuccess: () => {},
        onError: (errors) => {
            console.log(errors);
        },
    });
    hideDialog();
};

const showDialog = (event: Event, surveyId: number) => {
    event.stopPropagation();
    selectedSurvey.value = surveyId;
    dialogVisibility.value = true;
};
const hideDialog = () => {
    dialogVisibility.value = false;
};
</script>

<template>
    <Head title="Surveys" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl mb-4 text-white">Surveyys</h2>
            <AlertBox
                :flash="$page.props.flash"
                :errors="$page.props.errors.description"
            />
            <div>
                <div class="w-full flex justify-end">
                    <Link
                        class="mb-2 px-2 py-1 bg-emerald-500 text-white rounded shadow transition-all hover:bg-emerald-600 font-bold"
                        href="/surveys/create"
                        >New survey</Link
                    >
                </div>

                <ul>
                    <li v-for="survey in surveys.data" :key="survey.id">
                        <button
                            @click="loadSurvey(survey.id)"
                            class="mt2 mb-2 border border-white-700 hover:border-white"
                        >
                            <div class="text-white text-xl">
                                {{ survey.title }}
                            </div>
                            <div>
                                {{ survey.description }}
                            </div>
                            <div class="flex justify-end">
                                <p class="mr-2">
                                    modified:
                                    {{ survey.modified_at }}
                                </p>
                                <button
                                    class=""
                                    @click="showDialog($event, survey.id)"
                                >
                                    <XMarkIcon
                                        class="size-5 text-red-500 transition-all hover:text-red-300"
                                    />
                                </button>
                            </div>
                        </button>
                    </li>
                </ul>
            </div>
            <pre class="text-white">{{ $page.props.flash }}</pre>
            <pre class="text-white">{{ JSON.stringify(surveys, null, 2) }}</pre>
            <ConfirmationDialog
                :visible="dialogVisibility"
                message="Are you sure you want to delete this survey?"
                @cancel="hideDialog"
                @confirm="deleteSurvey"
            />
        </template>
    </AuthenticatedLayout>
</template>
