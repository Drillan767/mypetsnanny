<template>
    <section id="presentation" class="bg-white border-b">
        <div class="container max-w-5xl mx-auto">
            <h1 class="w-full mb-2 text-5xl font-bold leading-tight text-center text-gray-800">Qui suis-je ?</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-50 my-0 py-0 rounded-t"></div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/2 p-6">
                    <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">{{ $page.landing.whoami_title }}</h3>
                    <p class="text-gray-600 mb-8" v-for="(paragraph, i) in paragraphs" :key="i">
                        {{ paragraph }}
                    </p>
                </div>
                <div class="w-full sm:w-1/2 p-6">
                    <img :src="$page.landing.whoami_image" class="w-full mx-auto" alt="Qui suis-je ?" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    computed: {
        paragraphs () {
            return JSON.parse(this.$page.landing.whoami_text)
        }
    }
}
</script>
