<template>
  <div class="flex flex-col items-center justify-center w-full h-full">
      <div class="flex flex-col items-center justify-center w-1/2 space-y-4">

          <h1 class="text-4xl font-bold text-center text-primary">Track Order</h1>

          <BreezeValidationErrors class="mb-4" />

          <form @submit.prevent="submit" class="flex flex-col w-1/2 space-y-12">
              <div class="flex flex-col items-center justify-center space-y-2">
                  <BreezeLabel for="email" value="Order I.D" />
                  <BreezeInput placeholder="Eg: #AC287NC25" id="email" type="text" class="block w-full mt-1" v-model="form.email" autofocus />
              </div>
              
              <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Next
              </BreezeButton>
          </form>
      </div>
  </div>
</template>

<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
export default {
  components: {
    BreezeValidationErrors,
    BreezeInput,
    BreezeLabel,
    BreezeButton
  },
  data() {
      return {
          form: this.$inertia.form({
              id: '',
          })
      }
  },

  methods: {
      submit() {
          this.form.post(this.route('track-device'), {
              onFinish: (data) => console.log(data),
          })
      }
  }
}
</script>