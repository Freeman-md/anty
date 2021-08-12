<template>
  <Head title="Fix My Device" />

  <div class="flex flex-col items-center justify-center responsive-container">
    <transition-group name="switch" mode="out-in">
    
      <Devices @deviceSelected="setDevice" v-if="show === 'devices'" />

      <Brands @brandSelected="setBrand"  :device="device" v-if="show === 'brands'" />  

      <Issues @issueSelected="setIssue" v-if="show === 'issues'" />
      
      <div class="flex flex-col items-center justify-center -space-y-4" v-if="!show && loading">
        <img :src="$page.props.images.loading" class="object-cover" />
        <span class="text-lg font-semibold">Please wait while we send in your request...</span>
      </div>
      
      <div v-if="!show && !loading" class="flex flex-col items-center justify-center space-y-4">
        <div class="flex items-center justify-center space-x-6">
          <img :src="$page.props.images.checkmark" class="object-cover w-80 h-80" />
          <div class="flex flex-col items-center justify-center w-1/2 space-y-2 text-lg font-semibold">
            <span>Your Order ID is <span class="font-black">{{ orderId }}.</span></span>
            <span>Please do not lose this ID.</span>
            <span class="text-center">This is how you will be able to log in and check your order's status and updates.</span>
          </div>
        </div>
        <div class="flex items-center justify-center">
          <Link :href="route('index')" class="text-white transition duration-200 button-primary button bg-primary rounded-xl">
            Finish
          </Link>
        </div>
      </div>

    </transition-group>
    
  </div>
</template>

<script>
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import Devices from '@/Sections/Devices.vue'
import Brands from '@/Sections/Brands.vue'
import Issues from '@/Sections/Issues.vue'
export default {
  layout: BreezeGuestLayout,
  components: {
    Head,
    Link,
    Devices,
    Brands,
    Issues,
  },
  setup() {
    const show = ref('devices')
    const device = ref('')
    const brand = ref('')
    const issue = ref('')
    const loading = ref(false)
    const orderId = ref('')
    
    const setDevice = (selectedDevice) => {
      device.value = selectedDevice
      show.value = 'brands'
    }

    const setBrand = (selectedBrand) => {
      brand.value = selectedBrand
      show.value = 'issues'
    }

    const setIssue = (selectedIssue) => {
      issue.value = selectedIssue
      show.value = ''
      fixMyDevice()
    }

    const isLoading = (value) => {
      loading.value = value
    }

    const fixMyDevice = async() => {
      isLoading(true)
      setTimeout(() => {isLoading(false); orderId.value = '#A5DG62HD'}, 5000)
    }

    return {
      show, device, brand, loading, orderId, setDevice, setBrand, issue, setIssue
    }
  }
}
</script>

<style scoped>
/* switch transitions */
.switch-enter-from {
  opacity: 0;
  transform: translate(100px);
}

.switch-enter-active {
  transition: all 0.3s ease-out;
}

.switch-leave-to {
  opacity: 0;
  transform: translate(-100px);
}

.switch-leave-active {
  transition: all 0.3s ease-in;
}
</style>