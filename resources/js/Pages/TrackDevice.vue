<template>
    <Head title="Track Device" />
    
    <TrackDeviceForm v-if="bids.length >= 0" @foundDevice="getDeviceBids" />

    <DeviceBids v-else :bids="bids" :orderId="orderId"  />
    
</template>

<script>
import { reactive, ref } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import TrackDeviceForm from '@/Sections/TrackDeviceForm.vue'
import DeviceBids from '@/Sections/DeviceBids.vue'

export default {
    layout: BreezeGuestLayout,
    
    components: {
      Head,
      Link,      
      TrackDeviceForm,
      DeviceBids
    },

    setup() {
        const orderId = ref('')
        const bids = reactive([{name: 'Mr. Kenneth', rating: '4', price: '30'}])
        
        const getDeviceBids = (gottenBids, id) => {
            bids = gottenBids
            orderId = id
        }

        return {
            bids, getDeviceBids, orderId
        }
    }
}
</script>
