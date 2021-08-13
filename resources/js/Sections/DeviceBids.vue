<template>
  <div class="flex flex-col items-start space-y-10 responsive-container">
    <h1 class="text-4xl font-bold text-center text-primary">Your Dashboard ({{ orderNumber }})</h1>
    <div class="flex flex-col items-start w-full space-y-5">
      <span class="text-2xl font-bold">Bids</span>
      <table class="items-center w-full text-lg bg-transparent sm:w-2/3">
        <thead>
          <tr class="border-b-2 border-black">
            <th :class="theadClasses">
              Name
            </th>
            <th :class="theadClasses">
              Rating
            </th>
            <th :class="theadClasses">
              Price ($)
            </th>
            <!-- <th :class="theadClasses">
              
            </th> -->
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
                <span class="text-primary" :class="[index + 1 <= bid.rating ? 'fas fa-star' : 'far fa-star' ]" v-for="(n, index) in 5" :key="index"></span>
              </td>
              <td :class="tbodyClasses">
                {{ bid.price }}
              </td>
              <td class="flex items-center justify-start p-4 px-1 space-x-2 font-normal align-middle whitespace-nowrap">
                <span class="text-green-500 cursor-pointer fas fa-check"></span>
                <span class="text-red-500 cursor-pointer fa fa-times"></span>
              </td>
          </tr>
          <span v-show="bids.length <= 0" class="p-4 px-1 font-normal align-middle whitespace-nowrap">Bids not available</span>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
export default {
  props: ['bids', 'orderNumber'],
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