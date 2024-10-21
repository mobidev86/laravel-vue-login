<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});


const validationErrors = ref({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});


const validateForm = () => {
    let isValid = true;


    validationErrors.value = {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    };


    if (!form.name) {
        validationErrors.value.name = 'The name field is required.';
        isValid = false;
    }


    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!form.email) {
        validationErrors.value.email = 'The email field is required.';
        isValid = false;
    } else if (!emailPattern.test(form.email)) {
        validationErrors.value.email = 'Please enter a valid email address.';
        isValid = false;
    }


    if (!form.password) {
        validationErrors.value.password = 'The password field is required.';
        isValid = false;
    } else if (form.password.length < 6) {
        validationErrors.value.password = 'Password must be at least 6 characters long.';
        isValid = false;
    }


    if (form.password_confirmation !== form.password) {
        validationErrors.value.password_confirmation = 'The password field confirmation does not match.';
        isValid = false;
    }

    return isValid;
};


const submit = () => {
    if (validateForm()) {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="validationErrors.name || form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="validationErrors.email || form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="validationErrors.password || form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="validationErrors.password_confirmation || form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
