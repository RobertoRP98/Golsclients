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
            :title="model.service.name"   
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
                        <b>{{ $t('service') }}: </b>
                        <a class="hover:text-danger">
                            {{ model.service?.name }}
                        </a>
                    </p>
                    <p>
                        <b>{{ $t('plan') }}: </b>
                        <a class="hover:text-danger">
                            {{ model.name }}
                        </a>
                    </p>
                    <p>
                        <b>{{ $t('price') }}: </b>
                        <a class="hover:text-danger">
                            price
                        </a>
                    </p> 
                    <p>
                        <b>{{ $t('Fecha de contratacion') }}: </b>
                        <a class="hover:text-danger">
                            FECHA INICIO
                        </a>
                    </p>
                    <p>
                        <b>{{ $t('Fecha de terminacion') }}: </b>
                        <a class="hover:text-danger">
                            FECHA FINAL
                        </a>
                    </p>
                   
                </div>
            </div>
        </div>
    </ShowModal>
</template>