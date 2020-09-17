<template>
    <div>
        <div class="mt-4">
            <jet-input type="text" class="mt-1 block w-3/4" placeholder="Titre"
               ref="title"
               v-model="category.title"
               autofocus
            />

            <jet-input-error :message="category.error('title')" class="mt-2" />
        </div>
        <div class="mt-4">
            <jet-textarea :placeholder="'description'" v-model="category.description"></jet-textarea>

            <jet-input-error :message="category.error('title')" class="mt-2" />
        </div>

        <div class="mt-4 col-span-6 sm:col-span-4">
            <!-- Category Icon File Input -->
            <input type="file" class="hidden" ref="icon" @change="updateIconPreview" />

            <jet-label for="icon" value="Image" />

            <!-- New Profile Icon Preview -->
            <div class="mt-2" v-show="iconPreview">
                <span class="block rounded-full w-20 h-20"
                    :style="'background-size: cover; background-repeat: no-repeat; background-position: center; background-image: url(\'' + iconPreview + '\');'">
                </span>
            </div>

            <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewIcon">
                Sélectionnez une nouvelle image
            </jet-secondary-button>

            <jet-input-error :message="category.error('icon')" class="mt-2" />
        </div>

        <div class="mt-4">
            <jet-label for="color" value="Couleur" />
            <slider id="color" v-model="color" @change="colorChange" />
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center mt-3">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" v-model="category.whole_day" :checked="category.whole_day">
                <span class="ml-2 text-gray-700">La prestation dure-t-elle toute la journée ?</span>
            </label>
        </div>
    </div>
</template>

<script>
import Slider from 'vue-color/src/components/Slider.vue';
import JetButton from './../../Jetstream/Button';
import JetLabel from './../../Jetstream/Label';
import JetSecondaryButton from './../../Jetstream/SecondaryButton';
import JetInput from './../../Jetstream/Input';
import JetTextarea from './../../Jetstream/Textarea';
import JetInputError from './../../Jetstream/InputError';
export default {
    components: {
        JetButton,
        JetInput,
        JetLabel,
        JetTextarea,
        JetInputError,
        JetSecondaryButton,
        'Slider': Slider
    },

    props: ['category'],

    data () {
        return {
            iconPreview: null,
            color: '',
        }
    },

    methods: {
        updateIconPreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.iconPreview = e.target.result;
            };
            reader.readAsDataURL(this.$refs.icon.files[0]);
        },

        selectNewIcon() {
            this.$refs.icon.click();
        },

        colorChange(e) {
            console.log('changed');
        }
    }

}
</script>
