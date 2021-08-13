<template>
  <div class="flex flex-col items-center justify-center space-y-4">
    <h1 class="text-4xl font-bold text-center text-primary">Hello</h1>

    <span class="my-4 text-base font-bold">Select Your Device</span>

    <div class="grid gap-y-4 sm:gap-12 sm:grid-cols-3">
      
      <div
        v-for="(deviceItem, index) in devices"
        :key="index"
        class="flex flex-col items-center justify-center px-4 py-2 space-y-2 text-base font-semibold transition duration-300 border-4 cursor-pointer rounded-3xl hover:bg-black hover:bg-opacity-50"
        :class="[device === deviceItem ? 'border-primary' : 'border-gray-500']"
        @click.prevent="changeDevice(deviceItem)"
      >
        <span>{{ deviceItem }}</span>
        <img :alt="deviceItem" class="object-cover" :src="$page.props.images[deviceItem.toLowerCase()]" />
      </div>

    </div>

    <div>
      <BreezeButton :class="{'opacity-25': !device}" :disabled="!device" @click.prevent="deviceSelected">
        Next
      </BreezeButton>
    </div>
  </div>
</template>

<script>
import { reactive, ref } from 'vue'
import BreezeButton from '@/Components/Button.vue'
export default {
  components: { BreezeButton },
  setup(props, {emit}) {
    const device = ref('')
    const devices = reactive(['Mobile','Laptop','Desktop'])

    const changeDevice = (selectedDevice) => {
      device.value = selectedDevice
    }
    
    const deviceSelected = () => {
      emit('deviceSelected', device.value)
    }

    return {
      device,
      devices,
      changeDevice,
      deviceSelected
    }
  }
}
</script>