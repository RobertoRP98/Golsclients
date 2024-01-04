<script setup>
import { can } from './Component'

import Header from '@/Components/Dashboard/Modal/Elements/Header.vue';
import ShowModal  from '@/Components/Dashboard/Modal/Show.vue';
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';

defineEmits([
    'close', 
    'switchModal'
]);

defineProps({
    show: Boolean,
    model: Object
});
</script>
<template>
    <ShowModal
        :show="show"
        :editable="can('edit')"
        @close="$emit('close')"
        @edit="$emit('switchModal')"
        editable
    >
        <Header
            :title="model.name"
        >
        </Header>
        <div class="py-2 border-b">
            <div class="px-4 py-2 flex">
                <GoogleIcon 
                    class="text-xl text-success"
                    name="home_repair_service"
                />
                <div class="pl-3">
                    <p>
                        <b>{{ $t('client') }}: </b>
                        <a :href="`name:${model.name}`" target="_blank" class="hover:text-danger">
                            {{ model.name }}
                        </a>
                    </p>
                    <p>
                        <b>{{ $t('email') }}: </b>
                        <a :href="`email:${model.email}`" target="_blank" class="hover:text-danger">
                            {{ model.email }}
                        </a>
                    </p>
                    <p>
                        <b>{{ $t('telephone_company') }}: </b>
                        <a :href="`telephone_company:${model.telephone_company}`" target="_blank" class="hover:text-danger">
                            {{ model.telephone_company }}
                        </a>
                    </p><p>
                        <b>{{ $t('contact_company') }}: </b>
                        <a :href="`contact_company:${model.contact_company}`" target="_blank" class="hover:text-danger">
                            {{ model.contact_company }}
                        </a>
                    </p><p>
                        <b>{{ $t('phone_contact') }}: </b>
                        <a :href="`phone_contact:${model.phone_contact}`" target="_blank" class="hover:text-danger">
                            {{ model.phone_contact }}
                        </a>
                    </p><p>
                        <b>{{ $t('email_contact') }}: </b>
                        <a :href="`email_contact:${model.email_contact}`" target="_blank" class="hover:text-danger">
                            {{ model.email_contact }}
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </ShowModal>
</template>