<script setup>
import { goTo, transl } from './Component';
import { Link, useForm } from '@inertiajs/vue3';
import PrimaryButton   from '@/Components/Dashboard/Button/Primary.vue';
import Input           from '@/Components/Dashboard/Form/Input.vue';
import Selectable           from '@/Components/Dashboard/Form/Selectable.vue';
import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref } from 'vue';

//este props trae la informacion de los services
const props = defineProps({
    services: Object,
});

const form = useForm({
    service_id:'',
    name: '',
    price: '',
   
});

//Se hace referencia a service
const service = ref();

//Pasamos en forma de transform el data, capturando el servicio_id y el valor de este
const submit = () => form.transform(data => ({
        ...data,
        service_id: service.value.id
    })).post(route(goTo('store')), {
    onSuccess: () => Notify.success(transl('create.onSuccess')),
    onError:   () => Notify.error(transl('create.onError')),
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
            <div class="col-span-2">
                <!-- Para el selectable pasamos el vmodel declarado arriba en props-->
            <Selectable 
            title="Servicios"
            v-model="service"
            :options="services"
            placeholder="Servicio"
            :onError="form.errors.service_id"
                autofocus
                required></Selectable>
        </div>
        
            <Input
                id="name"
                class="col-span-2"
                v-model="form.name"
                :onError="form.errors.name"
                autofocus
                required
            />
            <Input
                id="price"
                class="col-span-2"
                v-model="form.price"
                :onError="form.errors.price"
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
