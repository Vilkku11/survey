<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ConfirmationDialog from "../../Components/ConfirmationDialog.vue";
import Question from "../../Components/Question.vue";
import AlertBox from "@/Components/AlertBox.vue";
import { Head, useForm, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

type SurveyData = {
    id: number;
    title: string;
    description: string;
    created_at: string;
    modified_at: string;
};

type Survey = {
    data: SurveyData;
};

const props = defineProps<{
    survey: Survey;
    questions: Object;
}>();

const dialogVisibility = ref<boolean>(false);
const editMode = ref<boolean>(false);

const showDialog = () => {
    dialogVisibility.value = true;
};

const hideDialog = () => {
    dialogVisibility.value = false;
};

const deleteSurvey = () => {
    router.delete(`/surveys/${props.survey.data.id}`, {
        onSuccess: () => {
            console.log("success");
            router.get("/surveys");
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
    hideDialog();
};

const toggleEditMode = () => {
    editMode.value = !editMode.value;
};

const form = useForm({
    title: props.survey.data.title,
    description: props.survey.data.description,
});

const onSubmit = () => {
    console.log("submit");
    changedData.patch(`/surveys/${props.survey.data.id}`, {
        onSuccess: () => {},
        onError: (errors) => {
            console.log(errors);
        },
    });
};
const changedData: Record<string, unknown> = {};

watch(form, (newForm) => {
    console.log("hey i changed");
    for (const key in newForm) {
        if (newForm[key] != props.survey.data[key as keyof SurveyData]) {
            changedData[key] = newForm[key];
        }
    }
    console.log(changedData);
});
</script>

<template>
    <Head title="Survey" />
    <AuthenticatedLayout>
        <template #header>
            <div class="">
                <AlertBox
                    :flash="$page.props.flash"
                    :errors="$page.props.errors.description"
                />
                <div class="w-full flex justify-end">
                    <button
                        :class="{
                            'mb-2 px-2 py-1 text-white rounded shadow transition-all font-bold': true,
                            'bg-emerald-500 hover:bg-emerald-600': !editMode,
                            'bg-red-500 hover:bg-red-600': editMode,
                        }"
                        @click="toggleEditMode"
                    >
                        {{ editMode ? "Cancel" : "Edit" }}
                    </button>
                </div>

                <div v-if="editMode">
                    <form @submit.prevent="onSubmit">
                        <InputLabel value="title" />
                        <TextInput type="text" v-model="form.title" />
                        <InputLabel value="description" />
                        <TextInput type="text" v-model="form.description" />
                        <div class="mt-4 text-right">
                            <button
                                type="button"
                                @click="showDialog"
                                class="mb-2 px-2 py-1 text-white rounded shadow transition-all font-bold bg-red-500 hover:bg-red-600"
                            >
                                Delete
                            </button>
                            <button
                                type="submit"
                                class="mb-2 px-2 py-1 bg-emerald-500 text-white rounded shadow transition-all hover:bg-emerald-600 font-bold"
                            >
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                <div v-else>
                    <h1 class="text-white">Survey</h1>
                    <h1 class="">Title</h1>
                    <h2>{{ survey.data.title }}</h2>
                    <h1 class="">Description</h1>
                    <h2>{{ survey.data.description }}</h2>
                </div>
            </div>
            <ConfirmationDialog
                :visible="dialogVisibility"
                message="Do you really want to delete this survey?"
                @cancel="hideDialog"
                @confirm="deleteSurvey"
            />
            <ul>
                <li v-for="question in questions.data" :key="question.id">
                    <Question
                        :question="question.question"
                        :type="question.type"
                        :editMode="editMode"
                    />
                </li>
            </ul>
            <pre class="text-white">{{
                JSON.stringify(questions, null, 2)
            }}</pre>
            <pre class="text-white">{{ JSON.stringify(survey, null, 2) }}</pre>
        </template>
    </AuthenticatedLayout>
</template>
