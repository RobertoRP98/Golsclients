<script setup>
const props = defineProps({
    client:Object,
});

</script>

<template>
<div class="w-full justify-center py-5 px-5 gap-2 ">
    <div class="rounded-2xl w-[400px] overflow-hidden shadow-xl bg-slate-600">
      <!-- Contenido de la tarjeta aquí -->
    <div class="p-7 text-xl">
      <h1 class="font-extrabold text-white-50 mb-1"> {{ client.name }}</h1>
      <p class="font- text-white-50 mb-1"> {{ client.contact_company }}</p>
      <p class="font- text-white-50 mb-5"> {{ client.telephone_company }}</p>
      <div class="flex gap-6">
        <div class="rounded-full bg-gray-200 py-1 px-2 text-gray-800 hover:bg-gray-500 hover:text-gray cursor-pointer">
            Agregar planes
        </div>
      </div>
    </div>
</div>
</div>
</template>