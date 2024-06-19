<script setup lang="ts">
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import QuestionCard from "../../Components/QuestionCard.vue";

defineProps<{
    questions: Object;
}>();

const updateQuestion = (questionId: number, newQuestion: string) => {
    questions.data.find(
        (question: any) => question.id === questionId
    ).question = newQuestion;
};
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
                            <QuestionCard
                                :question="question.question"
                                @update:question="
                                    (newQuestion) =>
                                        updateQuestion(question.id, newQuestion)
                                "
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
