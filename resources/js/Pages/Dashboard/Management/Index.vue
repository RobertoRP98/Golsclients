<script setup>
import { transl, can, goTo } from './Component' //goTO tiene las rutas que toman los modales
import { ref } from 'vue';
import { Link  } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import ModalController    from '@/Controllers/ModalController.js';
import SearcherController from '@/Controllers/SearcherController.js';
import SearcherHead    from '@/Components/Dashboard/Searcher.vue';
//import DestroyView     from './Destroy.vue';
//import EditView        from './Edit.vue';
//import ShowView        from './Show.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';

//este props trae la informacion de los clientes
const props = defineProps({
    contracts: Object,
    client:Object,
});

// Controladores
const Modal    = new ModalController();
const Searcher = new SearcherController(goTo('index'));


// Variables de controladores
//const destroyModal = ref(Modal.destroyModal);
//const editModal    = ref(Modal.editModal);
//const showModal    = ref(Modal.showModal);
//const modelModal   = ref(Modal.modelModal);
const query        = ref(Searcher.query);

</script>
<template>
    <DashboardLayout :title="transl('system')">
      <SearcherHead @search="Searcher.search" />
      <div class="flex w-full justify-center py-11 gap-5 bg-white">
        <div class="rounded-2xl w-[400px] overflow-hidden shadow-xl bg-slate-600">
          <!-- Contenido de la tarjeta aquí -->
        <div class="p-7 text-xl">
          <h1 class="font-extrabold text-white-50 mb-5"> Aquí va el título</h1>
          <p class="text-slate-50 mb-5">
            Aqui deberian ir sus servicios y planes
          </p>
          <div class="flex gap-6">
            <div class="rounded-full bg-gray-200 py-1 px-2 text-gray-800 hover:bg-gray-500 hover:text-gray cursor-pointer">
                Agregar planes
            </div>
          </div>
        </div>
    </div>
 </div>
    </DashboardLayout>
  </template>
  


    