<script setup lang="ts">
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';




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
    survey:Survey,
}>();

const editMode = ref(false);

const toggleEditMode = () => {
    editMode.value = !editMode.value;
}


const form = useForm({
    title: props.survey.data.title,
    description: props.survey.data.description,
})

const onSubmit = () => {
    console.log("submit");
    form.put(`/surveys/${props.survey.data.id}`);
}

</script>

<template>
    <Head title="Survey" />
    <AuthenticatedLayout>
        <template #header>

            <div class="">

                <div class="w-full flex justify-end">
                    <button
                        :class="{
                            'mb-2 px-2 py-1 text-white rounded shadow transition-all font-bold': true,
                            'bg-emerald-500 hover:bg-emerald-600': !editMode,
                            'bg-red-500 hover:bg-red-600': editMode
                        }"
                        @click="toggleEditMode"
                        >{{ editMode ? 'Cancel' : 'Edit' }}</button>
                </div>

                <div v-if="editMode">
                    <form @submit.prevent="onSubmit">
                        <InputLabel value="title" />
                        <TextInput type="text" v-model="form.title" />
                        <InputLabel value="description" />
                        <TextInput type="text" v-model="form.description" />
                        <div class="mt-4 text-right">
                            <button
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
            <pre class="text-white">{{ JSON.stringify(survey, null, 2) }}</pre>
        </template>
    </AuthenticatedLayout>
</template>