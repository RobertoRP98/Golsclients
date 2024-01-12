<script setup>
import { transl, can, goTo } from './Component' //goTO tiene las rutas que toman los modales
import { ref } from 'vue';
import { Link  } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ModalController    from '@/Controllers/ModalController.js';
import SearcherController from '@/Controllers/SearcherController.js';
import SearcherHead    from '@/Components/Dashboard/Searcher.vue';
import Card    from '@/Components/Dashboard/Card.vue';
import Cards    from '@/Components/Dashboard/Cards.vue';

//este props trae la informacion de los clientes
const props = defineProps({
    clients:Object,
});

// Controladores
const Searcher = new SearcherController(goTo('index'));

const query        = ref(Searcher.query);
</script>

<template>
    <DashboardLayout :title="transl('system')">
      <SearcherHead @search="Searcher.search" />
   <!-- {{ clients }} -->
     <!-- {{ clients.service?.name }} -->

     <div class="w-full justify-center ">
    <div class="py-5 px-5 gap-2">
    <Cards>
      <Card v-for="client in clients.data" :key="client.id" :client="client"></Card>
    </Cards>
  </div>
</div>

    </DashboardLayout>
  </template>
  


    