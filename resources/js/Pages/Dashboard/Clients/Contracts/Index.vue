<script setup>
import { transl, can, goTo } from './Component' //goTO tiene las rutas que toman los modales
import { ref } from 'vue';
import { Link  } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import ModalController    from '@/Controllers/ModalController.js';
import SearcherController from '@/Controllers/SearcherController.js';
import SearcherHead    from '@/Components/Dashboard/Searcher.vue';
import DestroyView     from './Destroy.vue';
import EditView        from './Edit.vue';
import ShowView        from './Show.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import { objectPick } from '@vueuse/core';

//este props trae la informacion de los clientes
const props = defineProps({
    contracts: Object,
    client:Object,
});

// Controladores
const Modal    = new ModalController();
const Searcher = new SearcherController(goTo('index'));

// Variables de controladores
const destroyModal = ref(Modal.destroyModal);
const editModal    = ref(Modal.editModal);
const showModal    = ref(Modal.showModal);
const modelModal   = ref(Modal.modelModal);
const query        = ref(Searcher.query);

</script>
<template>
    <DashboardLayout :title="transl('system') + client?.name">
        <SearcherHead @search="Searcher.search">
            <Link
                :href="route(goTo('contracts.create'),client.id)"
            >
                <GoogleIcon
                    :title="$t('crud.create')"
                    class="btn-icon-primary"
                    name="add"
                    outline
                />
            </Link>
        </SearcherHead>
        <div class="pt-2 w-full">
            <Table 
                :items="contracts"
                @send-pagination="Searcher.searchWithPagination"
            >
                <template #head>
                    <th
                        class="table-item"
                        v-text="$t('service')"
                    />
                    <th
                        class="table-item"
                        v-text="$t('plan')"
                    />
                    
                    <th
                        class="table-item w-44"
                        v-text="$t('actions')"
                    />
                </template>
                <template #body="{items}">
                    <tr v-for="model in items">
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                              <p class="font-semibold">
                                {{ model.service?.name }}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div class="text-left">
                              <p class="font-semibold">
                                {{ model.name}}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                            <div class="flex justify-center space-x-2">
                                <GoogleIcon
                                    :title="$t('crud.show')"
                                    class="btn-icon-primary"
                                    name="visibility"
                                    outline
                                    @click="Modal.switchShowModal(model)"
                                />
                                <GoogleIcon
                                    v-if="can('edit')"
                                    :title="$t('crud.edit')"
                                    class="btn-icon-primary"
                                    name="edit"
                                    outline
                                    @click="Modal.switchEditModal(model)"
                                />
                                <GoogleIcon
                                    v-if="can('destroy')"
                                    :title="$t('crud.destroy')"
                                    class="btn-icon-primary"
                                    name="delete"
                                    outline
                                    @click="Modal.switchDestroyModal(model)"
                                />
                            </div>
                        </td>
                    </tr>
                </template>
                <template #empty>
                    <td class="table-item border">
                        <div class="flex items-center text-sm">
                          <div>
                            <p class="font-semibold">
                                {{ $t('registers.empty') }}
                            </p>
                          </div>
                        </div>
                    </td>
                    <td class="table-item border">-</td>
                    <td class="table-item border">-</td>
                </template>
            </Table>
        </div>
        
        <ShowView 
            v-if="can('index')"
            :show="showModal" 
            :model="modelModal" 
            @switchModal="Modal.switchShowEditModal"
            @close="Modal.switchShowModal"
        />
        <EditView
            v-if="can('edit')"
            :show="editModal"
            :model="modelModal"
            @switchModal="Modal.switchShowEditModal"
            @close="Modal.switchEditModal"
        />
        <DestroyView
            v-if="can('create')"
            :show="destroyModal"
            :model="modelModal"
            @close="Modal.switchDestroyModal"
        />
    </DashboardLayout>
</template>
    