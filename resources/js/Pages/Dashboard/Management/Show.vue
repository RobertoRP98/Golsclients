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
        @close="$emit('close')"
        editable
    >
        <Header
            :title="model"
        >
        </Header>
        <div class="py-2 border-b">
            <div class="px-4 py-2 flex">
                <GoogleIcon 
                    class="text-xl text-success"
                    name="contact_mail"
                />
                <div class="pl-3">
                    <p class="font-bold text-lg leading-none pb-2">
                        {{ $t('Información del plan') }}
                    </p>
                    <p>
                        <b>{{ $t('plan') }}: {{ model.plans?.name }}   </b>
                    </p>
                    <p>
                        <b>{{ $t('email') }}: </b>
                        <a :href="`mailto:${model.email}`" target="_blank" class="hover:text-danger">
                            {{ model.email }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </ShowModal>
</template>