<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-main text-main-on dark:bg-main-dark dark:text-main-dark-on">
        <div class="text-primary dark:text-white">
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-page dark:bg-page-dark shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
