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
                    name="checklist"
                />
                <div class="pl-3">
                    <p>
                        <b>{{ $t('Plan') }}: </b>
                        <a :href="`name:${model.name}`" target="_blank" class="hover:text-danger">
                            {{ model.name }}
                        </a>
                    </p>
                    <p>
                        <b>{{ $t('Precio') }}: </b>
                        <a :href="`description:${model.price}`" target="_blank" class="hover:text-danger">
                            {{ model.price }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </ShowModal>
</template>