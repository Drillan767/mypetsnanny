<template>
    <transition
        enter-active-class="ease-in-out duration-500"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="ease-in-out duration-500"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-show="isOpened" class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div v-show="isOpened" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
                    <transition
                        enter-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                        enter-class="translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                        leave-class="translate-x-0"
                        leave-to-class="translate-x-full"
                    >
                        <div v-show="isOpened" class="relative w-screen max-w-md">
                            <transition
                                enter-active-class="ease-in-out duration-500"
                                enter-class="opacity-0"
                                enter-to-class="opacity-100"
                                leave-active-class="ease-in-out duration-500"
                                leave-class="opacity-100"
                                leave-to-class="opacity-0"
                            >
                                <div v-show="isOpened" class="absolute top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4">
                                    <button @click.prevent="close" aria-label="Close panel" class="text-gray-300 hover:text-white transition ease-in-out duration-150">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </transition>
                            <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                                <header class="px-4 sm:px-6">
                                    <h2 class="text-lg leading-7 font-medium text-gray-900">
                                        {{ title }}
                                    </h2>
                                </header>
                                <div class="relative flex-1 px-4 sm:px-6">
                                    <slot name="slide-over"></slot>
                                </div>
                            </div>
                        </div>
                    </transition>
                </section>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props: ['title', 'isOpened'],

    methods: {
        close () {
            this.$emit('close-slide', false);
        }
    }
}
</script>
