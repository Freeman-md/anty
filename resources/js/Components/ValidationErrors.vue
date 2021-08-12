<template>
    <div v-if="hasErrors" class="flex flex-col items-start w-full p-3 space-y-2 text-sm font-bold text-white bg-red-600 border-l-4 border-red-800 shadow-xl sm:w-2/3 lg:w-1/2 rounded-l-md bg-opacity-70">
        <span v-for="(error, key) in errors" :key="key">{{ error }}</span>
    </div>
</template>

<script>
export default {
    computed: {
        errors() {
            return this.$page.props.errors
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0
        },
    }
}
</script>
