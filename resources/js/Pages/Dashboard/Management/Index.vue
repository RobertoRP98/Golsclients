<script setup>
import { transl, can, goTo } from './Component' //goTO tiene las rutas que toman los modales
import { ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ModalController    from '@/Controllers/ModalController.js';
import SearcherController from '@/Controllers/SearcherController.js';
import SearcherHead    from '@/Components/Dashboard/Searcher.vue';
import Card    from '@/Components/Dashboard/Card.vue';
import Cards    from '@/Components/Dashboard/Cards.vue';
import ShowView        from './Show.vue';


//este props trae la informacion de los clientes
const props = defineProps({
    clients:Object,
});

// Controladores
const Modal    = new ModalController();

// Variables de controladores
const showModal    = ref(Modal.showModal);
const modelModal   = ref(Modal.modelModal);

// Controladores
const Searcher = new SearcherController(goTo('index'));

const query        = ref(Searcher.query);

</script>

<template>
    <DashboardLayout :title="transl('system')">
      <SearcherHead @search="Searcher.search" />
     <div class="w-full justify-center ">
    <div class="py-5 px-5 gap-2">
    <Cards 
      :items="clients"
      @send-pagination="Searcher.searchWithPagination"
    >
      <Card v-for="client in clients.data" :key="client.id" :client="client" @open="Modal.switchShowModal"></Card>
    </Cards>
  </div> 
</div>
        <ShowView 
            v-if="can('index')"
            :show="showModal" 
            :model="modelModal" 
            @close="Modal.switchShowModal"
        />
    </DashboardLayout>
  </template>
  


    