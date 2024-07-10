<script setup lang="ts">
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "../../Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from '@inertiajs/vue3';

type SurveyData = {
    id: number,
    title: string,
    description: string,
    created_at: string,
    modified_at: string,

}

type Survey = {
    data: SurveyData;
}

const props = defineProps<{
    survey: Survey;
}>();

const form = useForm({
    title: props.survey.data.title,
    description: props.survey.data.description,

})


const onSubmit = () => {

}
</script>


<template>
    <Head title="Edit survey" />
    <AuthenticatedLayout>
        <template #header>
            <div>
                <h1 class="text-black">Edit</h1>
                <form @submit.prevent="onSubmit">
                    <InputLabel value="title" />
                    <TextInput type="text" v-model="form.title" />
                    <InputLabel value="description" />
                    <TextInput type="text" v-model="form.description" />
                </form>
            </div>
            <pre class="text-white">{{ JSON.stringify(survey, null, 2) }}</pre>
        </template>
    </AuthenticatedLayout>
</template>
