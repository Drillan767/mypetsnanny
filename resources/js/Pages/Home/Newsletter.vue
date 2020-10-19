<template>
    <section id="newsletter" class="bg-white px-4 xl:px-0 pt-24">
        <div class="container mx-auto">
            <div class="relative border shadow border-gray-200 rounded-lg px-4 py-6 overflow-hidden sm:px-6 sm:py-8 lg:p-12 xl:p-16">
                <form @submit.prevent="newsletterSubmit" class="mt-6 lg:w-1/2">
                    <h2 class="text-2xl leading-8 font-semibold font-display text-gray-900 sm:text-3xl sm:leading-9">We've got more coming...</h2>
                    <p class="mt-2 max-w-2xl text-base leading-6 text-gray-500">
                        Want to hear from us when we add new components? Sign up for our newsletter and we'll email you every time we release a new batch of components.
                    </p>
                    <p v-if="success">Bien ouej</p>
                    <div class="sm:flex mt-4">
                        <JetInput type="email" class="w-full md:w-auto" v-model="newsletter.email" required="required" placeholder="Entrez votre email" />
                        <button class="landing-button sm:ml-4" :class="{ 'opacity-25': newsletter.processing }" :disabled="newsletter.processing"
                        >
                            Inscription
                        </button>
                    </div>
                    <jet-input-error :message="newsletter.error('email')" class="mt-2" />
                </form>
                <div class="hidden lg:block absolute inset-y-0 lg:left-2/3 xl:left-1/2 right-0 nwsltr-img">
                    <img src="//loremflickr.com/600/300" class="w-full h-full object-cover object-left" alt="image" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import JetInput from '../../Jetstream/Input'
import JetInputError from '../../Jetstream/InputError'
export default {
    components: {
        JetInput,
        JetInputError,
    },

    data () {
        return {
            newsletter: this.$inertia.form({
                'email': ''
            }),
            success: false
        }
    },

    methods: {
        newsletterSubmit () {
            this.newsletter.post('/newsletter')
            .then(() => this.success = true)
        }
    }
}
</script>
