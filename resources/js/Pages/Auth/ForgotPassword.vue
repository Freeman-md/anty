<template>
    <Head title="Forgot Password" />

    <div class="flex flex-col items-center justify-center w-full">
        <div class="flex flex-col items-center justify-center w-full space-y-4 sm:w-2/3 lg:w-1/2">

            <h1 class="text-4xl font-bold text-center text-primary">Forgot Password</h1>

            <div class="w-full mb-4 text-sm text-gray-600 sm:w-2/3 lg:w-1/2">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <BreezeValidationErrors class="mb-4" />

            <form @submit.prevent="submit" class="flex flex-col w-full space-y-4 sm:w-2/3 lg:w-1/2">
                <div>
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput id="email" type="email" class="block w-full mt-1" v-model="form.email" autofocus/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </BreezeButton>
                </div>
            </form>

        </div>

    </div>
    
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
