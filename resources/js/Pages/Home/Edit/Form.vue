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
                        <img :src="landing.hero_banner" alt="Bannière actuelle" class="rounded h-30 w-40 object-cover">
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

                    <jet-label for="photo" value="Identifiant de la vidéo bannière" />
                    <jet-input id="hero_video" type="text" class="mt-1 block w-full" v-model="landing.hero_video" autocomplete="hero_video" />
                    <p class="mt-2 font-medium text-xs text-gray-400">
                        Exemple : youtube.com/watch?v=<b>tkN2-Tyvk18</b>
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

                    <jet-label for="photo" value="Image de fond de la partie Newsletter" />

                    <!-- Current Newsletter Image -->
                    <div class="mt-2" v-show="! newsletterPreview">
                        <img :src="landing.newsletter_image" alt="Image actuelle pour la newsletter" class="rounded h-30 w-40 object-cover">
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
                <div class="shadow overflow-hidden sm:rounded-md mb-5">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Titre" />
                                <jet-input class="mt-1 block w-full" v-model="landing.service1_title" autocomplete="service.title" />
                                <jet-input-error :message="landing.error('service1_title')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Texte" />
                                <jet-textarea v-model="landing.service1_text" />
                                <jet-input-error :message="landing.error('service1_text')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <!-- Service File Input -->
                                <input type="file" class="hidden"
                                       ref="service1_image"
                                       @change="updatePhotoPreview($event, 'service1_image', 'service1Preview')">

                                <jet-label for="photo" value="Image bannière" />

                                <!-- Current Service Image -->
                                <div class="mt-2" v-show="! service1Preview">
                                    <img :src="landing.service1_image" alt="Illustration du service" class="rounded h-30 w-40 object-cover">
                                </div>

                                <!-- New Service Preview -->
                                <div class="mt-2" v-show="service1Preview">
                                    <span class="block rounded w-40 h-20"
                                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + service1Preview + '\');'">
                                    </span>
                                </div>

                                <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('service1_image')">
                                    Sélectionnez une nouvelle image
                                </jet-secondary-button>

                                <jet-input-error :message="landing.error('service1_image')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow overflow-hidden sm:rounded-md mb-5">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Titre" />
                                <jet-input class="mt-1 block w-full" v-model="landing.service2_title" autocomplete="service.title" />
                                <jet-input-error :message="landing.error('service2_title')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label value="Texte" />
                                <jet-textarea v-model="landing.service2_text" />
                                <jet-input-error :message="landing.error('service2_text')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <!-- Service File Input -->
                                <input type="file" class="hidden"
                                       ref="service2_image"
                                       @change="updatePhotoPreview($event, 'service2_image', 'service2Preview')">

                                <jet-label for="photo" value="Image bannière" />

                                <!-- Current Service Image -->
                                <div class="mt-2" v-show="! service2Preview">
                                    <img :src="landing.service2_image" alt="Illustration du service" class="rounded h-30 w-40 object-cover">
                                </div>

                                <!-- New Service Preview -->
                                <div class="mt-2" v-show="service2Preview">
                                    <span class="block rounded w-40 h-20"
                                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + service2Preview + '\');'">
                                    </span>
                                </div>

                                <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('service2_image')">
                                    Sélectionnez une nouvelle image
                                </jet-secondary-button>

                                <jet-input-error :message="landing.error('service2_image')" class="mt-2" />
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
                        <img :src="landing.whoami_image" alt="Illustration de la newsletter" class="rounded h-30 w-40 object-cover">
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
                Gallerie photo
            </template>

            <template #description>
                Ajoutez des images de balades belles à en décoller la rétine.
            </template>

            <template #fields>
                <div class="col-span-6 sm:col-span-4">
                    <input type="file" class="hidden"
                           ref="gallery"
                           multiple="multiple"
                           @change="updateGallery">

                    <jet-label for="photo" value="Gallerie" />

                    <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewFile('gallery')">
                        Sélectionnez des images
                    </jet-secondary-button>

                    <jet-input-error :message="landing.error('gallery')" class="mt-2" />

                    <div class="mt-4 gap-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        <div v-for="image in galleryPreview" class="h-12" :key="image.index">
                            <img :src="image.path" class="block cursor-pointer h-full" alt="preview" :data-id="image.index" @click="removeImage">
                        </div>
                    </div>

                    <p v-if="galleryPreview.length > 0" class="mt-2 font-medium text-xs text-gray-400">
                        Cliquer sur une image pour la supprimer
                    </p>
                </div>

            </template>
        </jet-section>

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
                    <!-- Contact File Input -->
                    <input type="file" class="hidden"
                           ref="contact_image"
                           @change="updatePhotoPreview($event, 'contact_image', 'contactPreview')">

                    <jet-label for="photo" value="Image de présentation" />

                    <!-- Current Contact Image -->
                    <div class="mt-2" v-show="! contactPreview">
                        <img :src="landing.contact_image" alt="Image de fond pour les contact" class="rounded h-30 w-40 object-cover">
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
import {Inertia} from "@inertiajs/inertia";

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
            landing: this.$inertia.form({
                ...this.$page.landing
            }),
            // Previews
            heroBannerPreview: null,
            newsletterPreview: null,
            whoamiPreview: null,
            contactPreview: null,
            service1Preview: null,
            service2Preview: null,
            gallery: [],
            galleryPreview: [],

        }
    },

    mounted() {
        this.galleryPreview = JSON.parse(this.landing.gallery) || [];
        ['whoami_text', 'service1_text', 'service2_text'].forEach(text => this.landing[text] = this.striptags(this.landing[text]));
    },

    methods: {
        submit () {
            window.scrollTo({top: 0, behavior: 'smooth'});

            ['whoami_text', 'service1_text', 'service2_text'].forEach(text => this.landing[text] = this.toParagraphs(this.landing[text]));

            // If each of these fields have a file, update the attribute with it, or simply remove it because a file is expected
            [
                'service1_image',
                'service2_image',
                'hero_banner',
                'newsletter_image',
                'whoami_image',
                'contact_image',

            ].forEach((field) => {
                this.$refs[field].files[0] ? this.landing[field] = this.$refs[field].files[0] : delete this.landing[field];
            });

            let formData = new FormData();
            for (const [key, value] of Object.entries(this.landing)) {
                if (key.charAt(0) !== '_' && !['processing', 'successful', 'recentlySuccessful', 'initial'].includes(key)) {
                    formData.append(key, value);
                }
            }

            this.gallery.forEach(image => formData.append('gallery[]', image.path));

            Inertia.post('/admin/editer-accueil', formData);
        },

        updatePhotoPreview (e, ref, prev) {
            const reader = new FileReader();
            reader.onload = (e) => this[prev] = e.target.result;
            reader.readAsDataURL(this.$refs[ref].files[0]);
        },

        updateGallery (e) {
            const selectedFiles = e.target.files;
            for (let i = 0; i < selectedFiles.length; i++) {
                this.gallery.push({index: i, path: e.target.files[i]});
                const reader = new FileReader();
                reader.onload = () => this.galleryPreview.push({index: i, path: reader.result});
                reader.readAsDataURL(e.target.files[i]);
            }
        },

        removeImage (e) {
            const id = parseInt(e.target.dataset.id)
            this.gallery = this.gallery.filter(g => g.index !== id);
            this.galleryPreview = this.galleryPreview.filter(g => g.index !== id);
        },

        selectNewFile (ref) {
            this.$refs[ref].click();
        },

        toParagraphs (value) {
            return JSON.stringify(value.split('\n').filter(p => p!== ''));
        },

        striptags (value) {
            return JSON.parse(value).join("\n\n");
        }
    },
}
</script>
