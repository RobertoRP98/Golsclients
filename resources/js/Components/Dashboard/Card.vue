<script setup>
import TableCard          from '@/Components/Dashboard/TableCard.vue';
const props = defineProps({
    client:Object,
});

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
        <TableCard 
                :items="client"
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
                </template>
                <template #body="{items}">
                    <tr v-for="model in items.plans">
                      <!-- {{ model }} -->
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
                </template>
            </TableCard>
      </div>
      
    </div>
</div>
</div>
</template>