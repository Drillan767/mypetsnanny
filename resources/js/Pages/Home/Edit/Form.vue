<template>
    <form @submit.prevent="submit">
        <jet-section>
            <template #title>
                Landing
            </template>

            <template #description>
                Le premier écran sur lequel les visiteurs arrivent.
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="hero_overtitle" value="Surtitre" />
                    <jet-input id="hero_overtitle" type="text" class="mt-1 block w-full" v-model="landing.hero_overtitle" autocomplete="hero_overtitle" />
                    <jet-input-error :message="landing.error('hero_overtitle')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="hero_title" value="Titre" />
                    <jet-input id="hero_title" type="text" class="mt-1 block w-full" v-model="landing.hero_title" autocomplete="hero_title" />
                    <jet-input-error :message="landing.error('hero_title')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="hero_subtitle" value="Sous-titre" />
                    <jet-input id="hero_subtitle" type="text" class="mt-1 block w-full" v-model="landing.hero_subtitle" autocomplete="hero_subtitle" />
                    <jet-input-error :message="landing.error('hero_subtitle')" class="mt-2" />
                </div>
            </template>
        </jet-section>

        <jet-section-border />

        <jet-section>
            <template #title>
                Newsletter
            </template>

            <template #description>
                Personnalisez les petits détails autour du formulaire.
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="newsletter_title" value="Titre" />
                    <jet-input id="newsletter_title" type="text" class="mt-1 block w-full" v-model="landing.newsletter_title" autocomplete="newsletter_title" />
                    <jet-input-error :message="landing.error('newsletter_title')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="newsletter_text" value="Texte" />
                    <jet-input id="newsletter_text" type="text" class="mt-1 block w-full" v-model="landing.newsletter_text" autocomplete="newsletter_text" />
                    <jet-input-error :message="landing.error('newsletter_text')" class="mt-2" />
                </div>
            </template>
        </jet-section>

        <jet-section-border />

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <jet-section-title>
                <template #title>
                    Services
                </template>
                <template #description>
                    Dites-en plus sur ce que vous proposez à vos clients.
                </template>
            </jet-section-title>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md mb-5" v-for="(service, i) in services" :key="i">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Texte" />
                                <jet-input type="text" class="mt-1 block w-full" v-model="landing.newsletter_text" autocomplete="newsletter_text" />
                                <jet-input-error :message="landing.error('newsletter_text')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import JetSection from '../../../Jetstream/Section'
import JetSectionTitle from '../../../Jetstream/SectionTitle'
import JetLabel from "../../../Jetstream/Label";
import JetInput from "../../../Jetstream/Input";
import JetInputError from "../../../Jetstream/InputError";
import JetButton from '../../../Jetstream/Button';
import JetSecondaryButton from '../../../Jetstream/SecondaryButton';
import JetSectionBorder from '../../../Jetstream/SectionBorder'

export default {
    components: {
        JetSection,
        JetSectionTitle,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetSecondaryButton,
        JetSectionBorder
    },

    data () {
        return {
            services: [],
            landing: this.$inertia.form({
                ...this.$page.landing
            })
        }
    },

    mounted() {
        this.services = JSON.parse(this.landing.services_data)
    },

    methods: {
        submit () {

        },

        addService () {
            this.services.push({title: '', 'text': '', image: ''})
        },

        removeService (e) {
            this.services = this.services.filter((s) => s.title !== e)
        }
    },
}
</script>
