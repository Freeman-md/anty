<template>
    <Header />
    
    <div class="px-4 py-8 mt-24">
        <slot />
    </div>
</template>

<script>
import Header from '@/Shared/Header.vue'

export default {
    components: {
        Header,
    }
}
</script>
