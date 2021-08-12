<template>
    <Head title="Sign Up" />

    <div class="flex items-center justify-center w-full space-x-6">
        <!-- Image -->
        <div class="-mt-20">
            <img :src="$page.props.images.artboard" class="object-cover" />
        </div>
        <!-- Content -->
        <div class="flex flex-col items-center w-1/2 space-y-4">

            <div>
                <h1 class="text-4xl font-bold text-primary">Sign Up</h1>
            </div>

            <span class="text-sm font-semibold">Already have an account? <Link :href="route('login')" class="text-primary">Sign In</Link></span>

            <Link class="flex items-center justify-center w-1/2 px-6 py-2 space-x-6 text-sm font-semibold text-black shadow-xl bg-light rounded-2xl">
                <img :src="$page.props.images.google" class="object-cover w-8 h-8" />
                <span>Sign up with Google</span>
            </Link>

            <span class="my-4 text-base font-bold lowercase">Or</span>
            
            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <BreezeValidationErrors class="mb-4" />

            <form @submit.prevent="submit" class="flex flex-col w-1/2 space-y-4">
                <div class="flex flex-col">
                    <BreezeLabel for="email" value="Email Address" />
                    <BreezeInput id="email" type="text" class="block w-full mt-1" v-model="form.email" autofocus />
                </div>

                <div class="flex flex-col">
                    <BreezeLabel for="password" value="Password" />
                    <BreezeInput id="password" type="password" class="block w-full mt-1" v-model="form.password" />
                </div>

                <div class="flex flex-col items-center justify-center w-full mt-4 space-y-4">
                    <span class="text-sm font-semibold">I agree to Anty's <Link :href="route('index')" class="text-red-500">Terms of Service</Link> and <Link :href="route('index')" class="text-red-500">Privacy Policy</Link></span>

                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
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
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    props: {
        status: String
    },

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>
