<template>
    <Head title="Log in" />

    <div class="flex flex-col items-center justify-center w-full">
        <div class="flex flex-col items-center justify-center w-1/2 space-y-4">

            <h1 class="text-4xl font-bold text-center text-primary">Log In</h1>

            <Link class="flex items-center justify-center w-1/2 px-6 py-2 space-x-6 text-sm font-semibold text-black shadow-xl bg-light rounded-2xl">
                <img :src="$page.props.images.google" class="object-cover w-8 h-8" />
                <span>Sign in with Google</span>
            </Link>

            <span class="my-4 text-base font-bold lowercase">Or</span>

            <BreezeValidationErrors class="mb-4" />

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="flex flex-col w-1/2 space-y-4">
                <div class="flex flex-col items-center justify-center">
                    <BreezeLabel for="email" value="Email Address" />
                    <BreezeInput id="email" type="text" class="block w-full mt-1" v-model="form.email" autofocus />
                </div>

                <div class="flex flex-col items-center justify-center">
                    <BreezeLabel for="password" value="Password" />
                    <BreezeInput id="password" type="password" class="block w-full mt-1" v-model="form.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="flex flex-col items-center justify-center w-full mt-4 space-y-4">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm hover:underline ">
                        Forgot your password?
                    </Link>

                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </BreezeButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
