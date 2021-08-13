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
        <div class="flex flex-col items-center justify-center space-y-6 sm:space-y-0 sm:space-x-6 sm:flex-row">
          <img :src="$page.props.images.checkmark" class="object-cover w-60 h-60 sm:w-80 sm:h-80" />
          <div class="flex flex-col items-center justify-center space-y-2 text-lg font-semibold text-center sm:w-1/2">
            <span>Your Order ID is <span class="font-black">{{ orderNumber }}.</span></span>
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
import { ref, onMounted } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import Devices from '@/Sections/Devices.vue'
import Brands from '@/Sections/Brands.vue'
import Issues from '@/Sections/Issues.vue'
export default {
  layout: BreezeGuestLayout,
  props: {
    orderNumber: {
      required: false,
      default: ''
    }
  },
  components: {
    Head,
    Link,
    Devices,
    Brands,
    Issues,
  },
  setup(props) {
    const show = ref('devices')
    const device = ref('')
    const brand = ref('')
    const issue = ref('')
    const loading = ref(false)
    const orderId = ref('')

    onMounted(() => {
      if (props.orderNumber) {
        show.value = ''
      }
    })
    
    const setDevice = (selectedDevice) => {
      device.value = selectedDevice.toLowerCase()
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

    const fixMyDevice = async function() {
      isLoading(true)
      Inertia.post('/fix-my-device', 
      {
        'device': device.value, 
        'brand': brand.value, 
        'issue': issue.value
      }, 
      {
        onFinish: () => {
          if(props.orderNumber) isLoading(false)
        }
      })
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