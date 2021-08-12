<template>
  <div class="flex flex-col items-start space-y-10 responsive-container">
    <h1 class="text-4xl font-bold text-center text-primary">Your Dashboard ({{ orderId }})</h1>
    <div class="flex flex-col items-start w-full space-y-5">
      <span class="text-2xl font-bold">Bids</span>
      <table class="items-center w-2/3 text-lg bg-transparent">
        <thead>
          <tr class="border-b-2 border-black">
            <th :class="theadClasses">
              Name
            </th>
            <th :class="theadClasses">
              Rating
            </th>
            <th :class="theadClasses">
              Price
            </th>
            <th :class="theadClasses">
              
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(bid, index) in bids"
            :key="index"
            class="border-b-2 border-gray-500 "
          >
              <td class="text-left" :class="tbodyClasses">
                {{ bid.name }}
              </td>
              <td :class="tbodyClasses">
                {{ bid.rating }}
              </td>
              <td :class="tbodyClasses">
                {{ bid.price }}
              </td>
              <td :class="tbodyClasses" class="relative">
                <span class="cursor-pointer fas fa-ellipsis-v" @click.prevent="toggleDropdown"></span>
                <transition name="dropdown">
                  <div class="absolute left-0 z-40 flex flex-col items-start w-32 px-4 py-3 ml-4 -mt-8 space-y-2 text-sm font-semibold text-gray-800 origin-top-left bg-white rounded-md shadow-md" v-if="showDropdown">
                  <span class="transition duration-200 cursor-pointer hover:text-black">
                    Accept
                  </span>
                  <span class="transition duration-200 cursor-pointer hover:text-black">
                    Reject
                  </span>
                  </div>
                </transition>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
export default {
  props: ['bids', 'orderId'],
  setup() {
    const showDropdown = ref(false)
    const theadClasses = ref('px-1 py-3 font-semibold tracking-wider text-left align-middle whitespace-nowrap')
    const tbodyClasses = ref('p-4 px-1 font-normal align-middle whitespace-nowrap')

    const toggleDropdown = () => {
      showDropdown.value = !showDropdown.value
    }

    return {
      showDropdown, theadClasses, tbodyClasses, toggleDropdown
    }
  }
}
</script>

<style scoped>
.dropdown-enter-active {
  transition: ease-out 200ms;
}   
.dropdown-enter-from,
.dropdown-leave-to  {
  transform: scale(0.9);
  opacity: 0;
}
.dropdown-enter-to, 
.dropdown-leave-from{
  transform: scale(1);
  opacity: 100;
}

.dropdown-leave-active {
  transition: ease-in 75ms;
}

</style>