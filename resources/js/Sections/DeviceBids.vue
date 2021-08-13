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
              <td class="p-4 px-1 font-normal align-middle whitespace-nowrap">
                <div class="items-center justify-start space-x-2 " v-if="!bid.status">
                  <span class="text-green-500 cursor-pointer fas fa-check" @click.prevent="acceptBid(bid.id)"></span>
                  <span class="text-red-500 cursor-pointer fa fa-times" @click.prevent="rejectBid(bid.id)"></span>
                </div>
                <span v-else class="text-base font-semibold">{{ bid.status }}</span>
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
import { Inertia } from '@inertiajs/inertia'
export default {
  props: ['bids', 'orderNumber'],
  setup() {
    const showDropdown = ref(false)
    const theadClasses = ref('px-1 py-3 font-semibold tracking-wider text-left align-middle whitespace-nowrap')
    const tbodyClasses = ref('p-4 px-1 font-normal align-middle whitespace-nowrap')

    const toggleDropdown = () => {
      showDropdown.value = !showDropdown.value
    }

    const acceptBid = async function(id) {
      await Inertia.post('/track-device/accept-bid', 
      {
        'bid_id': id,
      })
    }

    const rejectBid = async function(id) {
      await Inertia.post('/track-device/reject-bid', 
      {
        'bid_id': id,
      })
    }

    return {
      showDropdown, theadClasses, tbodyClasses, toggleDropdown, acceptBid, rejectBid
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