<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import axios from "axios";
import {ref, onBeforeMount} from 'vue'

const form = ref({
    title: null,
    description: null,
})

const submitData = () => {
    axios.post(route('notification.store'),form.value).then(response => {
        if(response.data.success){

        }
    })
}

const users = ref([])

const getData = (query) => {
    if (query !== '') {
        return new Promise((resolve, reject) => {
            axios.post(route('user.get'), {search: query}).then(response => {
                if (response.data.success) {
                    resolve(response.data.data.users)
                }
            })
        })
    }
}
onBeforeMount(() => {
    getData()
})

</script>

<template>
    <Head title="Notification"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notification</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto p-5">
                        <h4>Send Notification</h4>


                        <form class="max-w-md mx-auto" method="post" @submit.prevent="submitData" >
                            <div class="mb-5">
                                <label for="notification_title"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" id="notification_title"
                                       v-model="form.title"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required>
                            </div>
                            <div class="mb-5">
                                <label for="notification_title"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="notification_description"
                                          v-model="form.description"
                                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          required></textarea>
                            </div>

                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Submit
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
