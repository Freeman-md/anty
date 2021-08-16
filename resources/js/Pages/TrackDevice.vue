<template>
    <Head title="Track Device" />
    
    <TrackDeviceForm v-if="!found" :orderNumbers="orderNumbers" />

    <DeviceBids v-else :bids="bids" :orderNumber="orderNumber"  />
    
</template>

<script>
import { computed } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import TrackDeviceForm from '@/Sections/TrackDeviceForm.vue'
import DeviceBids from '@/Sections/DeviceBids.vue'

export default {
    layout: BreezeGuestLayout,

    props: {
        orderNumber: {
            required: false,
            default: ''
        },
        bids: {
            required: false,
            default: []
        },
        found: {
            required: false,
            default: false,
        },
        orderNumbers: {
            required: false,
            default: []
        }
    },
    
    components: {
      Head,
      Link,      
      TrackDeviceForm,
      DeviceBids
    },

    setup(props) {
        const orderNumber = computed(() => props.orderNumber)
        const bids = computed(() => props.bids)

        return {
            bids, orderNumber
        }
    }
}
</script>
