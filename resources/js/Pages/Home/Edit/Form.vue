<template>
    <form @submit.prevent="submit" method="POST">
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

                <div class="col-span-6 sm:col-span-4">
                    <!-- Profile Banner File Input -->
                    <input type="file" class="hidden"
                           ref="hero_banner"
                           @change="updatePhotoPreview($event, 'hero_banner', 'heroBannerPreview')">

                    <jet-label for="photo" value="Image bannière" />

                    <!-- Current Banner -->
                    <div class="mt-2" v-show="! heroBannerPreview">
                        <img :src="landing.hero_banner" alt="Current Profile Photo" class="rounded h-30 w-40 object-cover">
                    </div>

                    <!-- New Banner Preview -->
                    <div class="mt-2" v-show="heroBannerPreview">
                    <span class="block rounded w-40 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + heroBannerPreview + '\');'">
                    </span>
                    </div>

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('hero_banner')">
                        Sélectionnez une nouvelle image
                    </jet-secondary-button>

                    <jet-input-error :message="landing.error('hero_banner')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <!-- Profile Banner Video File Input -->
                    <input
                        type="file"
                        class="hidden"
                        ref="hero_video"
                        accept="video/*"
                        @change="updateVideoInfo"
                    />

                    <jet-label for="photo" value="Video bannière" />

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('hero_video')">
                        Sélectionnez une nouvelle vidéo
                    </jet-secondary-button>
                    <p class="mt-2 font-medium text-xs text-gray-400">
                        {{ landing.hero_video && heroVideoMessage.replace('@filename', landing.hero_video.replace(/^.*[\\\/]/, '')) }}
                    </p>

                    <jet-input-error :message="landing.error('hero_video')" class="mt-2" />
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

                <div class="col-span-6 sm:col-span-4">
                    <!-- Profile Newsletter File Input -->
                    <input type="file" class="hidden"
                           ref="newsletter_image"
                           @change="updatePhotoPreview($event, 'newsletter_image', 'newsletterPreview')">

                    <jet-label for="photo" value="Image bannière" />

                    <!-- Current Newsletter Image -->
                    <div class="mt-2" v-show="! newsletterPreview">
                        <img :src="landing.newsletter_image" alt="Current Profile Photo" class="rounded h-30 w-40 object-cover">
                    </div>

                    <!-- New Newsletter Preview -->
                    <div class="mt-2" v-show="newsletterPreview">
                    <span class="block rounded w-40 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + newsletterPreview + '\');'">
                    </span>
                    </div>

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('newsletter_image')">
                        Sélectionnez une nouvelle image
                    </jet-secondary-button>

                    <jet-input-error :message="landing.error('newsletter_image')" class="mt-2" />
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
                                <jet-label value="Titre" />
                                <jet-input class="mt-1 block w-full" v-model="service.title" autocomplete="service.title" />
                                <jet-input-error :message="landing.error('service.title')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Texte" />
                                <jet-textarea v-model="service.text" />
                                <jet-input-error :message="landing.error('newsletter_text')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <!-- Service File Input -->
                                <input type="file" class="hidden"
                                       :ref="`service_image_${i}`"
                                       @change="updatePhotoPreview($event, `service_image_${i}`, 'serviceImages')">

                                <jet-label for="photo" value="Image bannière" />

                                <!-- Current Service Image -->
                                <div class="mt-2" v-show="! newsletterPreview">
                                    <img :src="service.image" alt="Current Profile Photo" class="rounded h-30 w-40 object-cover">
                                </div>

                                <!-- New Service Preview -->
                                <div class="mt-2" v-show="newsletterPreview">
                                    <span class="block rounded w-40 h-20"
                                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + newsletterPreview + '\');'">
                                    </span>
                                </div>

                                <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('newsletter_image')">
                                    Sélectionnez une nouvelle image
                                </jet-secondary-button>

                                <jet-input-error :message="landing.error('newsletter_image')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <jet-section-border />

        <jet-section>
            <template #title>
                Qui suis-je ?
            </template>

            <template #description>
                Présentez-vous comme bon vous semble
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="whoami_title" value="Titre" />
                    <jet-input id="whoami_title" type="text" class="mt-1 block w-full" v-model="landing.whoami_title" autocomplete="whoami_title" />
                    <jet-input-error :message="landing.error('whoami_title')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="whoami_text" value="Description" />
                    <jet-textarea id="whoami_text" v-model="landing.whoami_text" />
                    <jet-input-error :message="landing.error('whoami_text')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <!-- Profile Newsletter File Input -->
                    <input type="file" class="hidden"
                           ref="whoami_image"
                           @change="updatePhotoPreview($event, 'whoami_image', 'whoamiPreview')">

                    <jet-label for="photo" value="Image de présentation" />

                    <!-- Current Newsletter Image -->
                    <div class="mt-2" v-show="! whoamiPreview">
                        <img :src="landing.whoami_image" alt="Current Profile Photo" class="rounded h-30 w-40 object-cover">
                    </div>

                    <!-- New Newsletter Preview -->
                    <div class="mt-2" v-show="whoamiPreview">
                    <span class="block rounded w-20 h-40"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + whoamiPreview + '\');'">
                    </span>
                    </div>

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('whoami_image')">
                        Sélectionnez une nouvelle image
                    </jet-secondary-button>

                    <jet-input-error :message="landing.error('whoami_image')" class="mt-2" />
                </div>
            </template>
        </jet-section>

        <jet-section-border />

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <jet-section-title>
                <template #title>
                    Comment ça marche ?
                </template>
                <template #description>
                    Dévoilez le secret derrière vos services
                </template>
            </jet-section-title>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md mb-5" v-for="n in 3" :key="n">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Titre" />
                                <jet-input class="mt-1 block w-full" v-model="landing[`getstarted${n}_title`]" :autocomplete="`getstarted${n}_title`" />
                                <jet-input-error :message="landing.error(`getstarted${n}_title`)" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Texte" />
                                <jet-textarea v-model="landing[`getstarted${n}_text`]" />
                                <jet-input-error :message="landing.error(`getstarted${n}_text`)" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <jet-section-border />

        <jet-section>
            <template #title>
                Partie contact
            </template>

            <template #description>
                Restez réceptive aux inquiétudes des gens sur leur toutous.
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="contact_subtitle" value="Sous-titre" />
                    <jet-input id="contact_subtitle" type="text" class="mt-1 block w-full" v-model="landing.contact_subtitle" autocomplete="contact_subtitle" />
                    <jet-input-error :message="landing.error('contact_subtitle')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <!-- Profile Newsletter File Input -->
                    <input type="file" class="hidden"
                           ref="contact_image"
                           @change="updatePhotoPreview($event, 'contact_image', 'contactPreview')">

                    <jet-label for="photo" value="Image de présentation" />

                    <!-- Current Newsletter Image -->
                    <div class="mt-2" v-show="! contactPreview">
                        <img :src="landing.contact_image" alt="Current Profile Photo" class="rounded h-30 w-40 object-cover">
                    </div>

                    <!-- New Newsletter Preview -->
                    <div class="mt-2" v-show="contactPreview">
                    <span class="block rounded w-40 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + contactPreview + '\');'">
                    </span>
                    </div>

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('contact_image')">
                        Sélectionnez une nouvelle image
                    </jet-secondary-button>

                    <jet-input-error :message="landing.error('contact_image')" class="mt-2" />
                </div>
            </template>
        </jet-section>

        <div class="flex justify-end py-12" >
            <button
                @click="submit"
                type="button"
                class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
            >
                Enregistrer
            </button>
        </div>
    </form>
</template>

<script>
import JetSection from '../../../Jetstream/Section';
import JetSectionTitle from '../../../Jetstream/SectionTitle';
import JetLabel from "../../../Jetstream/Label";
import JetInput from "../../../Jetstream/Input";
import JetInputError from "../../../Jetstream/InputError";
import JetButton from '../../../Jetstream/Button';
import JetSecondaryButton from '../../../Jetstream/SecondaryButton';
import JetSectionBorder from '../../../Jetstream/SectionBorder';
import JetTextarea from '../../../Jetstream/Textarea';

export default {
    components: {
        JetSection,
        JetSectionTitle,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        JetSecondaryButton,
        JetSectionBorder,
        JetTextarea,
    },

    data () {
        return {
            services: [],
            landing: this.$inertia.form({
                ...this.$page.landing
            }),
            heroVideoMessage: 'Vidéo actuelle : @filename',
            // Previews
            heroBannerPreview: null,
            newsletterPreview: null,
            whoamiPreview: null,
            contactPreview: null,
            serviceImages: [],

        }
    },

    mounted() {
        this.services = JSON.parse(this.landing.services_data)
    },

    methods: {
        submit () {
            this.landing.whoami_text = this.toParagraphs(this.landing.whoami_text);
            this.landing.services = JSON.stringify(this.services);
            ['hero_banner', 'hero_video', 'newsletter_image', 'whoami_image', 'contact_image'].forEach((field) => {
                this.landing[field] = this.$refs[field].files[0] || null;
            })
            this.landing.post('/admin/editer-accueil');
            // window.scrollTo({top: 0, behavior: 'smooth'});
        },

        updatePhotoPreview (e, ref, prev) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this[prev] = e.target.result;
            };
            reader.readAsDataURL(this.$refs[ref].files[0]);
        },

        updateVideoInfo (e) {
            this.heroVideoMessage = 'Vidéo chargée : ' + e.target.files[0].name
        },

        selectNewFile(ref) {
            this.$refs[ref].click();
        },

        toParagraphs(value) {
            const p_list = value.split('\n').filter(p => p!== '');
            let response = '';
            p_list.forEach((p) => response += `<p>${p}</p>`)

            return response
        }
    },
}
</script>
