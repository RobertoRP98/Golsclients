<script setup>
import TableCard          from '@/Components/Dashboard/TableCard.vue';
import { ref } from 'vue';

const props = defineProps({
    client:Object,
});

const emits = defineEmits([
    'open' 
]);


</script>

<template>
<div class="w-full justify-center mt-3 py-5 px-5 gap-2 bg-slate-200 bg-clip-border text-gray-700 shadow-lg  rounded-xl ">
    <div class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
      <!-- Contenido de la tarjeta aquí -->
    <div class="p-7 text-xl">
      <h1 class="font-extrabold text-white-50 text-2xl mb-1 "> {{ client.name }}</h1>
      <p class="font- text-white-50 text-lg mt-2 text-justify mb-1" > Nombre de contacto de la empresa: {{ client.contact_company }}</p>
      <p class="font- text-white-50 text-lg mb-0 text-justify"> Numero del contacto: {{ client.telephone_company }}</p>
      <div>
        <TableCard :items="client">
  <template #body="{ items }">
    <!-- Mostrar botones en lugar de filas de tabla -->
    <div class="grid grid-cols-2 gap-4">
    <template v-for="plan in items.plans">
      <button
        type="button"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded mb-2"
        @click="emits('open', plan)"
      >
        {{ plan.service?.name }} : {{ plan.name }}
      </button>
    </template>
  </div>
  </template>
  <template #empty>
    <!-- Manejar el caso cuando no hay datos -->
    <p>{{ $t('registers.empty') }}</p>
  </template>
</TableCard>

      </div>  
    </div>
</div>
</div>
</template>