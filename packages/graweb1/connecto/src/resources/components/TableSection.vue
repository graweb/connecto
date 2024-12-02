<template>
    <section class="relative bg-white shadow-md rounded-lg p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">{{ title }}</h2>
            <DropdownMenu @fetchTables="fetchTables" @openModal="openModal" :db="db" />
        </div>

        <div v-if="loading" class="text-gray-500 mt-4">Carregando...</div>
        <div v-if="error" class="text-red-500 mt-4">{{ error }}</div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4" v-if="tables.length > 0">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Table name</th>
                        <th scope="col" class="px-6 py-3 text-center">Size (mb)</th>
                        <th scope="col" class="px-6 py-3 text-center">Number of registers</th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="table in tables" :key="table"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
                            table.tabela }}</td>
                        <td class="px-6 py-4 text-center">{{ table.tamanho_mb }}</td>
                        <td class="px-6 py-4 text-center">{{ table.quantidade_registros }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script>
import DropdownMenu from '../components/DropdownMenu.vue';

export default {
    name: 'TableSection',
    components: { DropdownMenu },
    props: ['title', 'db', 'tables', 'loading', 'error'],
    methods: {
        fetchTables() {
            this.$emit('fetchTables', this.db);
        },
        openModal() {
            this.$emit('openModal', this.db);
        }
    }
};
</script>
