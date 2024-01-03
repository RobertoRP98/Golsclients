<script setup>
import { goTo, transl } from './Component';
import { Link, useForm } from '@inertiajs/vue3';

import PrimaryButton   from '@/Components/Dashboard/Button/Primary.vue';
import Input           from '@/Components/Dashboard/Form/Input.vue';
import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const form = useForm({
    name: '',
    email: '',
    telephone_company:'',
    contact_company:'',
    phone_contact:'',
    email_contact:'',
});

const submit = () => form.post(route(goTo('store')), {
    onSuccess: () => Notify.success(transl('create.onSuccess')),
    onError:   () => Notify.error(transl('create.onError')),
    onFinish:  () => form.reset('password')
});
</script>

<template>
  <DashboardLayout :title="transl('create.title')">
    <PageHeader>
        <Link :href="route(goTo('index'))">
            <GoogleIcon
                :title="$t('return')"
                class="btn-icon-primary"
                name="arrow_back"
                outline
            />
        </Link>
    </PageHeader>
    <div class="w-full pb-8">
        <div class="mt-8">
            <p
                v-text="transl('create.description')"
            />
      </div>
    </div>
    <div class="w-full">
        <form @submit.prevent="submit" class="grid gap-4 grid-cols-6">
            <Input
                id="name"
                class="col-span-2"
                v-model="form.name"
                :onError="form.errors.name"
                autofocus
                required
            />
            <Input
                id="email"
                class="col-span-2"
                v-model="form.email"
                :onError="form.errors.email"
                autofocus
                required
            />
            <Input
                id="telephone_company"
                class="col-span-2"
                v-model="form.telephone_company"
                :onError="form.errors.telephone_company"
                autofocus
                required
            /><Input
                id="contact_company"
                class="col-span-2"
                v-model="form.contact_company"
                :onError="form.errors.contact_company"
                autofocus
                required
            /><Input
                id="phone_contact"
                class="col-span-2"
                v-model="form.phone_contact"
                :onError="form.errors.phone_contact"
                autofocus
                required
            /><Input
                id="email_contact"
                class="col-span-2"
                v-model="form.email_contact"
                :onError="form.errors.email_contact"
                autofocus
                required
            />
            <div class="col-span-6 flex flex-col items-center justify-end space-y-4 mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }" 
                    :disabled="form.processing"
                    v-text="transl('create.title')"
                />
            </div>
        </form>
    </div>
  </DashboardLayout>
</template>
