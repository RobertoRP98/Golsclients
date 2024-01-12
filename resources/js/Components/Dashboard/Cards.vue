<script setup>
import Table           from '@/Components/Dashboard/Table.vue';

  const props = defineProps({
    client: Array,
  });
  </script>

<template>
    <div class="w-full">
      <!-- Espacio para mostrar las tarjetas -->
      <div  class="grid grid-cols-1 md:grid-cols-2 gap-2 ">
        <slot></slot>
      </div>
    </div>
  </template>
  
  
  