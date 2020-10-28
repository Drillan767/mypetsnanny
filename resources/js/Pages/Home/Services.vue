<template>
    <section id="services" class="bg-white py-8">
        <div class="container max-w-5xl mx-auto m-8">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Services</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-50 my-0 py-0 rounded-t"></div>
            </div>

            <div class="flex flex-wrap" v-for="s in 2" :key="s" :class="{ 'flex-col-reverse': s === 1, 'sm:flex-row': s === 1, 'mt-6': s === 2 }">
                <div class="w-full sm:w-1/2 p-6" v-if="s === 1">
                    <img :src="$page.landing[`service${s}_image`]" class="w-full sm:h-64 mx-auto" alt="image" />
                </div>
                <div class="w-full sm:w-1/2 p-6">
                    <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">{{ $page.landing[`service${s}_title`] }}</h3>
                    <p class="text-gray-600 mb-8" v-for="(paragraph, i) in paragraphs[s - 1]" :key="i">
                        {{ paragraph }}
                    </p>
                </div>
                <div class="w-full sm:w-1/2 p-6" v-if="s === 2">
                    <img :src="$page.landing[`service${s}_image`]" class="w-full sm:h-64 mx-auto" :alt="`Illustration de service n°${s}`" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    computed: {
        paragraphs () {
            return [
                    JSON.parse(this.$page.landing.service1_text),
                    JSON.parse(this.$page.landing.service2_text),
                ]
        }
    }
}
</script>
