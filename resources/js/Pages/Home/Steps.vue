<template>
    <section id="fonctionnement"  class="bg-gray-100 py-8">

        <div class="container mx-auto flex flex-wrap pt-4 xl:pb-12">

            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Comment ça marche ?</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-50 my-0 py-0 rounded-t"></div>
            </div>

            <div class="steps w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink" v-for="service in 3" :key="service">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="flex flex-col justify-center items-center text-center h-full md:py-4 xl:py-0">
                        <div class="w-full font-bold text-xl text-gray-800 px-6 mb-3">{{ $page.landing[`getstarted${service}_title`] }}</div>
                        <p class="text-gray-800 text-base px-6 mb-5">
                            {{ $page.landing[`getstarted${service}_text`] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
export default {}
</script>
