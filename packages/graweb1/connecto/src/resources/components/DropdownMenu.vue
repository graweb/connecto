<template>
    <div class="relative" ref="dropdown" @click.stop="toggleDropdown">
        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">⋮</button>
        <div v-if="isOpen" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10">
            <a @click="fetchTables"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Update</a>
            <a @click="openModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Create
                table</a>
            <a @click="openModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">New
                query</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "DropdownMenu",
    props: ['db'],
    data() {
        return {
            isOpen: false
        };
    },
    mounted() {
        document.addEventListener('click', this.closeDropdown);
    },
    beforeUnmount() {
        document.removeEventListener('click', this.closeDropdown);
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        closeDropdown(event) {
            if (this.isOpen && !this.$refs.dropdown.contains(event.target)) {
                this.isOpen = false;
            }
        },
        fetchTables() {
            this.$emit('fetchTables');
        },
        openModal() {
            this.$emit('openModal');
        }
    },
};
</script>
