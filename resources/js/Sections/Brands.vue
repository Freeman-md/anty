<template>
  <div class="flex flex-col items-center justify-center space-y-6">
    <h1 class="text-4xl font-bold text-center text-primary">Brands</h1>

    <div class="grid grid-cols-3 gap-12">
      <div
        v-for="(brandItem, index) in brands"
        :key="index"
        class="flex items-center justify-center p-4 text-base font-semibold transition duration-300 border-4 cursor-pointer rounded-3xl hover:bg-black hover:bg-opacity-50"
        :class="[brand === brandItem ? 'border-primary' : 'border-gray-500']"
        @click.prevent="changeBrand(brandItem)"
      >
        <span>{{ brandItem }}</span>
      </div>      
    </div>

    <div class="flex flex-col items-center space-y-2">
      <span class="text-base font-semibold" @click.prevent="changeBrand('Other')">Other...</span>
      <transition name="input">
        <BreezeInput v-if="brand === 'other'" type="text" class="block w-full mt-1" v-model="customBrand" placeholder="Enter your device brand"/>
      </transition>
    </div>

    <div>
      <BreezeButton :class="{'opacity-25': isBrandAvailable}" :disabled="isBrandAvailable" @click.prevent="brandSelected">
        Next
      </BreezeButton>
    </div>

  </div>
</template>

<script>
import { ref, computed } from 'vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeButton from '@/Components/Button.vue'
export default {
  props: {
    device: {
      type: String,
      required: true
    }
  },
  components: { BreezeInput, BreezeButton },
  setup(props, {emit}) {
    const brand = ref('')
    const customBrand = ref('')
    
    const brands = computed(() => {
      if (props.device === 'mobile') {
        return ['iPhone', 'Samsung', 'Huawei', 'Infinix', 'Tecno', 'Oppo']
      } else if (['laptop', 'desktop'].includes(props.device)) {
        return ['Apple', 'Samsung', 'Acer', 'HP', 'Asus', 'Razer', 'Lenovo', 'Alienware', 'Dell']
      }
    })

    const isBrandAvailable = computed(() => {
      if (!brand.value) return true
      else if (brand.value.toLowerCase() === 'other')
        if (!customBrand.value) return true
      return false
    })

    const changeBrand = (selectedBrand) => {
      brand.value = selectedBrand
    }

    const brandSelected = () => {
      emit('brandSelected', brand.value.toLowerCase())
    }

    return {
      brand,
      customBrand,
      brands,
      changeBrand,
      isBrandAvailable,
      brandSelected
    }
  }
}
</script>

<style scoped>
.input-enter-active {
  transition: ease-out 200ms;
}   
.input-enter-from,
.input-leave-to  {
  transform: scale(0.9);
  opacity: 0;
}
.input-enter-to, 
.input-leave-from{
  transform: scale(1);
  opacity: 100;
}

.input-leave-active {
  transition: ease-in 75ms;
}

</style>