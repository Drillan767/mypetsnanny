<template> <!--v-if="$page.landing.gallery.length > 0" -->
    <section id="gallery" class="bg-white px-4 xl:px-0 pt-24" v-if="$page.landing.gallery">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Ils étaient chez nous</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-50 my-0 py-0 rounded-t"></div>
        </div>

        <div class="container mx-auto flex flex-wrap pt-4 xl:pb-12">
            <CoolLightBox
                :items="images"
                :index="index"
                @close="index = null"
            />

            <div class="image-wrapper flex flex-wrap justify-center xl:justify-start mb-5">
                <div
                    class="image m-2"
                    v-for="(image, i) in images"
                    :key="i"
                    @click="index = i"
                    :style="{ backgroundImage: 'url(' + image + ')' }"
                >
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CoolLightBox from 'vue-cool-lightbox'
export default {
    components: {
        CoolLightBox,
    },

    data () {
        return {
            index: null,
        }
    },

    computed: {
        images () {
            return JSON.parse(this.$page.landing.gallery);
        }
    }
}
</script>
