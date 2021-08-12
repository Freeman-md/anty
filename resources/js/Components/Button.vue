<template>
    <button :type="type" class="w-full text-white transition duration-200 button-primary button bg-primary rounded-xl">
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'submit',
        },
    }
}
</script>
