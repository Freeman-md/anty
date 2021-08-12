<template>
  <div class="flex flex-col items-center justify-center space-y-6">
    <h1 class="text-4xl font-bold text-center text-primary">Details</h1>

    <div class="flex flex-col items-center justify-center space-y-4">
      
      <div class="grid grid-cols-2 gap-12">
        
        <!-- Available Issues -->
        <div class="flex flex-col items-start space-y-2 text-lg">
          <span>Please tell us your device's fault</span>
          <div class="relative flex items-center justify-between w-full px-6 py-2 space-x-6 text-sm font-semibold text-black shadow-xl cursor-pointer bg-light rounded-2xl" @click.prevent="toggleDropdown">
            <span class="flex flex-grow text-center">{{ issue || `What's the problem?` }}</span>
            <span class="fas fa-chevron-down"></span>
            <transition name="dropdown">
              <div class="absolute top-0 left-0 z-40 flex flex-col items-start w-48 px-4 py-3 mt-10 -ml-12 space-y-2 text-sm font-semibold text-gray-800 origin-bottom-left bg-white rounded-md shadow-md" v-if="showDropdown">
              <span 
                class="transition duration-200 cursor-pointer hover:text-black"
                v-for="(issueItem, index) in issues"
                v-show="issueItem !== issue"
                :key="index"
                @click.prevent="changeIssue(issueItem)"
              >
                {{ issueItem }}
              </span>
              </div>
            </transition>
          </div>
        </div>

        <!-- Custom Issues -->
        <div v-show="issue.toLowerCase() === 'other'" class="flex flex-col items-start space-y-2 text-lg">
          <span>If 'Other' please fill in the fault below</span>
          <transition>
            <textarea v-model="customIssue" class="py-3 text-black border-0 shadow-xl resize-none rounded-2xl bg-light focus:ring-0" rows="4"></textarea>
          </transition>
        </div>
        
      </div>

      <div>
        <BreezeButton :class="{'opacity-25': isIssueAvailable}" :disabled="isIssueAvailable" @click.prevent="issueSelected">
          Next
        </BreezeButton>
      </div>

    </div>
  </div>
</template>

<script>
import { ref, reactive, computed } from 'vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeButton from '@/Components/Button.vue'
export default {
  components: { BreezeInput, BreezeButton },
  setup(props, {emit}) {
    const issue = ref('')
    const customIssue = ref('')
    const showDropdown = ref(false)
    
    const issues = reactive([
      'Screen Damage', `Device won't come on`, 'Water Damage', 'Virus', 'Phone is locked', 'Other'
    ])

    const isIssueAvailable = computed(() => {
      if (!issue.value) return true
      else if (issue.value.toLowerCase() === 'other')
        if (!customIssue.value) return true
      return false
    })

    const changeIssue = (selectedIssue) => {
      issue.value = selectedIssue
    }

    const issueSelected = () => {
      emit('issueSelected', issue.value)
    }

    const toggleDropdown = () => {
      showDropdown.value = !showDropdown.value
    }

    return {
      issue,
      customIssue,
      showDropdown,
      issues,
      changeIssue,
      isIssueAvailable,
      issueSelected,
      toggleDropdown
    }
  }
}
</script>

<style scoped>
.dropdown-enter-active {
  transition: ease-out 200ms;
}   
.dropdown-enter-from,
.dropdown-leave-to {
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

.textarea-enter-active {
  transition: ease-out 200ms;
}   
.textarea-enter-from,
.textarea-leave-to {
  opacity: 0;
}
.textarea-enter-to, 
.textarea-leave-from{
  opacity: 100;
}

.textarea-leave-active {
  transition: ease-in 75ms;
}

</style>

