<template>
    <Head title="Reset Password" />

    <div class="flex flex-col items-center justify-center w-full">
        <div class="flex flex-col items-center justify-center w-full space-y-4 sm:w-2/3 lg:w-1/2">

            <h1 class="text-4xl font-bold text-center text-primary">Reset Password</h1>

            <BreezeValidationErrors class="mb-4" />

            <form @submit.prevent="submit" class="flex flex-col w-full space-y-4 sm:w-2/3 lg:w-1/2">
                <div>
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput id="email" type="email" class="block w-full mt-1" v-model="form.email" autofocus />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="password" value="Password" />
                    <BreezeInput id="password" type="password" class="block w-full mt-1" v-model="form.password" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="password_confirmation" value="Confirm Password" />
                    <BreezeInput id="password_confirmation" type="password" class="block w-full mt-1" v-model="form.password_confirmation"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Reset Password
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
        email: String,
        token: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.update'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
