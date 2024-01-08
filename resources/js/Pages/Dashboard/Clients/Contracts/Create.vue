<script setup>
import { goTo, transl } from './Component';
import { Link, useForm } from '@inertiajs/vue3';
import PrimaryButton   from '@/Components/Dashboard/Button/Primary.vue';
import Input           from '@/Components/Dashboard/Form/Input.vue';
import Selectable      from '@/Components/Dashboard/Form/Selectable.vue';
import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref, watch } from 'vue';

//este props trae la informacion de los services y plans
const props = defineProps({
    services: Object,
    plans: Object,
});

const form = useForm({
    service_id:'',
    plan_id:'',
});
//Se hace referencia a service
const service = ref();
//Se hace referencia a plan
const plan = ref();

const submit = () => form.transform(data=>({
    ...data,
    service_id: service.value.id,
    plan_id: plan.value.id
})).post(route(goTo('store')),{
    onSuccess: () => Notify.success(transl('create.onSuccess')),
    onError:   () => Notify.error(transl('create.onError')),
    onFinish:  () => form.reset('password')
});

watch(service, () => {
    axios.get(route('clients.contracts.services')).then(response => {
         plan.value=response.data.services;
    });
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
            <!-- Para el selectable pasamos el vmodel declarado arriba en props -->
            <!--para el :optiones="X" le tenemos que pasar esta variable desde el controlador en el area del create-->
            <div class="col-span-2">
            <Selectable 
            title="Servicios"
            v-model="service"
            :options="services"
            placeholder="Servicio"
            :onError="form.errors.service_id"
                autofocus
                required></Selectable>
        </div>
            <div class="col-span-2">
            <Selectable 
            title="Planes"
            v-model="plan"
            :options="plans"
            placeholder="Plan"
            :onError="form.errors.plan_id"
                autofocus
                required></Selectable>
        </div>

            
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
