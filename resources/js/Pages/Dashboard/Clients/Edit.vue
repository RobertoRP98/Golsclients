<script setup>
import { goTo } from './Component';
import { useForm } from '@inertiajs/vue3';
import { onUpdated } from 'vue';

import Input     from '@/Components/Dashboard/Form/Input.vue';
import EditModal from '@/Components/Dashboard/Modal/Edit.vue';
import Header    from '@/Components/Dashboard/Modal/Elements/Header.vue';

const emit = defineEmits([
    'close', 
    'switchModal'
]);

const props = defineProps({
    show: Boolean,
    model: Object
});

const form = useForm({});

const update = (id) => {
    form.transform(data => ({
        ...props.model
    })).put(route(goTo('update'), {id}),{
        preserveScroll: true,
        onSuccess: () => {
            Notify.success(lang('updated'))
            emit('switchModal')
        }
    });
}
</script>
<template>
    <EditModal
        :show="show"
        @close="$emit('close')"
        @update="update(model.id)" 
    >
        <Header
            :title="model.name"
        />
        <div class="py-2 border-b">
            <div class="p-4">
                <form>
                    <div class="grid gap-6 mb-6 lg:grid-cols-2">
                        <Input
                id="name"
                placeholder="Nombre"
                class="col-span-2"
                v-model="model.name"
                :onError="form.errors.name"
                autofocus
                required
            />
            <Input
                id="email"
                placeholder="Correo electronico de la empresa"
                class="col-span-2"
                v-model="model.email"
                :onError="form.errors.email"
                autofocus
                required
            />
            <Input
                id="telephone_company"
                placeholder="Telefono de la empresa"
                class="col-span-2"
                v-model="model.telephone_company"
                :onError="form.errors.telephone_company"
                autofocus
                required
            /><Input
                id="contact_company"
                placeholder="Titular o contacto de la empresa"
                class="col-span-2"
                v-model="model.contact_company"
                :onError="form.errors.contact_company"
                autofocus
                required
            /><Input
                id="phone_contact"
                placeholder="Telefono del contacto"
                class="col-span-2"
                v-model="model.phone_contact"
                :onError="form.errors.phone_contact"
                autofocus
                required
            /><Input
                id="email_contact"
                placeholder="Correo electronico del contacto"
                class="col-span-2"
                v-model="model.email_contact"
                :onError="form.errors.email_contact"
                autofocus
                required
            />
                    </div>
                </form>
            </div>
        </div>
    </EditModal>
</template>