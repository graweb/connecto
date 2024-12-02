<template>
    <div class="flex min-h-screen bg-gray-100">
        <Sidebar />
        <main class="ml-64 flex-1 p-6">
            <div class="w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                <TableSection title="Tabelas do Banco 1" :db="'db1'" :tables="tablesDb1" :loading="loadingDb1"
                    :error="errorDb1" @fetchTables="fetchTables" @openModal="openModal" />
                <TableSection title="Tabelas do Banco 2" :db="'db2'" :tables="tablesDb2" :loading="loadingDb2"
                    :error="errorDb2" @fetchTables="fetchTables" @openModal="openModal" />
            </div>
        </main>

        <ModalForm v-if="isModalOpen" :db="currentDb" @closeModal="closeModal" @submitForm="submitForm" />
    </div>
</template>

<script>
import axios from 'axios';
import Sidebar from '../components/Sidebar.vue';
import TableSection from '../components/TableSection.vue';
import ModalForm from '../components/ModalForm.vue';

export default {
    components: {
        Sidebar,
        TableSection,
        ModalForm
    },
    data() {
        return {
            tablesDb1: [],
            tablesDb2: [],
            loadingDb1: false,
            loadingDb2: false,
            errorDb1: '',
            errorDb2: '',
            isModalOpen: false,
            currentDb: ''
        };
    },
    mounted() {
        // Carrega as tabelas de ambos os bancos de dados ao montar o componente
        this.fetchTables('db1');
        this.fetchTables('db2');
    },
    methods: {
        async fetchTables(db) {
            if (db === 'db1') {
                this.loadingDb1 = true;
                this.errorDb1 = '';
            } else if (db === 'db2') {
                this.loadingDb2 = true;
                this.errorDb2 = '';
            }

            await axios.post('/list_tables', { db })
            .then((res) => {
                if (db === 'db1') {
                    this.tablesDb1 = res.data.tables;
                } else if (db === 'db2') {
                    this.tablesDb2 = res.data.tables;
                }
            })
            .catch((err) => {
                if (db === 'db1') {
                    this.errorDb1 = 'Erro ao carregar as tabelas do Banco 1.';
                } else if (db === 'db2') {
                    this.errorDb2 = 'Erro ao carregar as tabelas do Banco 2.';
                }
            })
            .finally(() => {
                if (db === 'db1') {
                    this.loadingDb1 = false;
                } else if (db === 'db2') {
                    this.loadingDb2 = false;
                }
            });
        },
        openModal(db) {
            this.currentDb = db;
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        async submitForm(data) {
            await axios.post('/create_table', {
                ...data
            })
            .finally(() => {
                this.closeModal();
            });
        }
    }
};
</script>

