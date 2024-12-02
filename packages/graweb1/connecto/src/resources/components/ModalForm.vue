<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Formulário do Banco {{ db }}</h3>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="tableName" class="block text-sm font-medium text-gray-700">Nome tabela</label>
                    <input id="tableName" name="tableName" v-model="tableName" type="text"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="closeModal"
                        class="mr-2 px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Fechar</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalForm",
    props: ['db'],
    data() {
        return {
            tableName: ''
        };
    },
    methods: {
        closeModal() {
            this.$emit('closeModal');
        },
        submitForm() {
            this.$emit('submitForm', { tableName: this.tableName });
        }
    }
};
</script>
