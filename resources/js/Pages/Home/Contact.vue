<template>
    <section id="contact" class="pb-12">

        <svg class="wave-top" viewBox="0 0 1439 147" xmlns="http://www.w3.org/2000/svg">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                    <g class="wave" fill="#f8fafc">
                        <path d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"></path>
                    </g>
                    <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
                        <g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
                            <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                            <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
                            <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" opacity="0.200000003"></path>
                        </g>
                    </g>
                </g>
            </g>
        </svg>

        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">Une question ?</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <h3 class="my-4 text-3xl leading-tight text-center">N'hésitez pas à me contacter via ce formulaire </h3>

        <div class="container mx-auto">
            <div class="flex">
                <div class="flex-1">
                    <div class="mt-2">
                        <JetInput v-model="contact.email" class="w-full" type="email" placeholder="Adresse email*" required />
                        <jet-input-error :message="contact.error('email')" class="mt-2" />
                    </div>
                    <div class="mt-2 flex">
                        <div class="flex-1">
                            <JetInput v-model="contact.first_name" class="w-full" placeholder="Prénom*" required />
                            <jet-input-error :message="contact.error('first_name')" class="mt-2" />
                        </div>
                        <div class="flex-1 ml-2">
                            <JetInput v-model="contact.last_name" class="w-full" placeholder="Nom de famille*" required />
                            <jet-input-error :message="contact.error('last_name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <select v-model="contact.subject" class="block appearance-none w-full text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <option value="">Selectionnez un sujet...</option>
                            <option v-for="(option, i) in subjects" :value="option" :key="i">{{ option }}</option>
                        </select>

                        <jet-input-error :message="contact.error('email')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full ml-4 flex-1">
                    <JetTextarea v-model="contact.message" placeholder="Écrivez votre message..." required />
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <JetButton>Envoyer</JetButton>
        </div>
    </section>
</template>

<script>
import JetButton from '../../Jetstream/Button';
import JetInput from '../../Jetstream/Input';
import JetTextarea from "../../Jetstream/Textarea";
import JetInputError from '../../Jetstream/InputError';
export default {
    components: {
        JetInput,
        JetInputError,
        JetTextarea,
        JetButton,
    },

    data () {
        return {
            contact: this.$inertia.form({
                first_name: '',
                last_name: '',
                email: '',
                subject: '',
                message: '',
                honey_pot: '',
            }),

            subjects: [
                'Option 1',
                'Option 2',
                'Option 3'
            ],
        }
    },

    methods: {
        contactSubmit () {

        }
    }
}
</script>
