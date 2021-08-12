<template>
    <Head title="Home" />
    <div class="flex items-center h-full space-x-4 responsive-container">
        
        <div class="flex flex-col items-start w-full space-y-6">
            <h2 class="text-5xl font-bold">Take Care Of Your <span class="text-primary">Devices</span></h2>
            
            <div class="flex flex-col items-start space-y-2">
                <p>Tell us what's wrong with your device by clicking on 'Fix My Device'</p>
                <p>Get a quote and have our delivery person come to pick up your device</p>
            </div>

            <div class="flex items-center space-x-8">
                <Link :href="route('fix-my-device')" class="text-white transition duration-200 button-primary button bg-primary rounded-3xl">Fix My Device</Link>
                <button disabled class="box-border transition duration-200 hover:bg-primary hover:text-white hover:border-0 hover:border-transparent border-2 py-2.5 border-primary text-primary button rounded-3xl">Get A Quote</button>
            </div>
        </div>

        <!-- Image -->
        <div class="flex items-center justify-center w-full -mt-10">
            <img :src="$page.props.images.brokenPhone" class="object-cover object-center h-96 w-96 grayscale-0" />
        </div>

    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeGuestLayout from '@/Layouts/Guest.vue'

export default {
    layout: BreezeGuestLayout, 
    
    components: {
      Head,
      Link,
    },
}
</script>
