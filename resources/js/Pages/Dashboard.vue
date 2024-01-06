<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import axios from "axios";
import {ref, onBeforeMount} from 'vue'

const offset = ref(0)
const limit = ref(10)
const total = ref(0)
const currentPage = ref(1)
const users = ref([])


const getData = () => {
    if (currentPage.value > 1) {
        offset.value = (currentPage.value - 1) * limit.value
    } else {
        offset.value = 0
    }
    axios.post(route('user.get'), {offset: offset.value, limit: limit.value}).then(response => {
        if (response.data.success) {
            users.value = response.data.data.users
            total.value = response.data.data.total
        }
    })
}

const handleSizeChange = (count) => {
    limit.value = count
    offset.value = 0
    currentPage.value = 1
    getData()
}
const handleCurrentChange = (page) => {
    currentPage.value = page
    getData()
}

onBeforeMount(() => {
    getData()
})

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto p-5">
                        <h4>Users</h4>
                        <el-table
                            :data="users"
                            stripe
                            style="width: 100%">
                            <el-table-column
                                prop="id"
                                label="ID"
                            />
                            <el-table-column
                                prop="name"
                                label="Name"
                            >
                            </el-table-column>
                            <el-table-column
                                prop="email"
                                label="Email"
                            >
                            </el-table-column>
                        </el-table>
                        <el-pagination
                            class="p-2"
                            :pager-count="11"
                            @size-change="handleSizeChange"
                            @current-change="handleCurrentChange"
                            :current-page.sync="currentPage"
                            layout="total, sizes, prev, pager, next, jumper"
                            :total="total">
                        </el-pagination>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
