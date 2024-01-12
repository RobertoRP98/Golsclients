<script setup>
const props = defineProps({
    items: Object,
});
</script>

<template>
    <!-- {{ items }} -->
    <section class="py-4">
        <div class="w-full overflow-hidden rounded-md shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="table-head">
                            <slot name="head" />
                        </tr>
                    </thead>
                    <tbody class="">
                        <!-- {{ items }}  -->
                     
                            <slot
                                name="body"
                                :items="items"
                            />
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    </template>