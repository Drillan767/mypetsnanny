<template>
    <section id="newsletter" class="bg-white px-4 xl:px-0 pt-24">
        <div class="container mx-auto">
            <div class="relative border shadow border-gray-200 rounded-lg px-4 py-6 overflow-hidden sm:px-6 sm:py-8 lg:p-12 xl:p-16">
                <form @submit.prevent="newsletterSubmit" class="mt-6 lg:w-1/2">
                    <h2 class="text-2xl leading-8 font-semibold font-display text-gray-900 sm:text-3xl sm:leading-9">{{ $page.landing.newsletter_title }}</h2>
                    <p class="mt-2 max-w-2xl text-base leading-6 text-gray-500">
                        {{ $page.landing.newsletter_text }}
                    </p>
                    <p v-if="success">Bien ouej</p>
                    <div class="sm:flex mt-4">
                        <JetInput type="email" class="w-full md:w-auto text-black" v-model="newsletter.email" required="required" placeholder="Entrez votre email" />
                        <button class="landing-button sm:ml-4" :class="{ 'opacity-25': newsletter.processing }" :disabled="newsletter.processing"
                        >
                            Inscription
                        </button>
                    </div>
                    <jet-input-error v-if="error" :message="error" class="mt-2" />
                    <p v-if="success" class="text-sm text-green-600 mt-2">Merci !</p>
                </form>
                <div class="hidden lg:block absolute inset-y-0 lg:left-2/3 xl:left-1/2 right-0 nwsltr-img">
                    <img :src="$page.landing.newsletter_image" class="w-full h-full object-cover object-left" alt="Illustration de la newsletter" />
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
            newsletter: {
                email: '',
                g_recaptcha_response: ''
            },
            success: false,
            error: null,
        }
    },

    methods: {
        newsletterSubmit () {
            this.error = null;
            this.$recaptcha('login').then(token => {
                this.newsletter.g_recaptcha_response = token
                this.$inertia.post('/newsletter', this.newsletter, {preserveScroll: true})
                    .then(() => {
                        if (this.$page.errors.email) {
                            this.error = this.$page.errors.email;
                        } else {
                            this.success = true;
                        }
                    })
            });

        }
    }
}
</script>
