<template>
    <div class="leading-normal tracking-normal text-white gradient">
        <!-- NAVIGATION -->
        <nav id="header" class="fixed w-full z-30 top-0 text-white bg-white shadow">

            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2 pr-4">

                <div class="pl-4 flex items-center">
                    <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"  href="/">
                        <!--Icon from: http://www.potlabicons.com/ -->
                        <img src="logo-horizontal.png" alt="logo" class="h-8 fill-current inline" />
                    </a>
                </div>

                <div class="block lg:hidden pr-4">
                    <button id="nav-toggle" @click="displayResponsiveMenu" class="flex items-center p-1 text-orange-800 hover:text-gray-900">
                        <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>

                <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
                    <ul class="list-reset lg:flex justify-end flex-1 items-center">
                        <li class="mr-3">
                            <a class="active inline-block py-2 px-4 text-black font-bold no-underline" href="#accueil">Accueil</a>
                        </li>
                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="#services">Services</a>
                        </li>
                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="#presentation">Qui suis-je ?</a>
                        </li>

                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="#fonctionnement">Comment ça marche ?</a>
                        </li>

                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <div class="block text-center lg:inline-block">
                        <a
                            href="/login"
                            class="
                                mx-auto
                                lg:mx-0
                                bg-white
                                cursor-pointer
                                text-gray-800
                                font-bold
                                rounded
                                mt-4
                                lg:mt-0
                                py-2 px-4
                                shadow
                                bg-gradient-to-r
                                from-teal-400
                                to-blue-500
                            ">
                            Connexion
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
        </nav>
        <!-- END NAVIGATION -->

        <!-- HERO -->
        <Hero />

        <!-- NEWSLETTER -->
        <Newsletter />

        <!-- SERVICES -->
        <Services />

        <!-- WHOAMI -->
        <Whoami />

        <!-- GETTING STARTED -->
        <Steps />

        <!-- PRICING -->
        <Pricing v-if="showPrices" />

        <!-- CALL TO ACTION -->
        <Contact />

        <!-- FOOTER -->
        <Footer />
    </div>
</template>

<script>
import Hero from "./Hero";
import Newsletter from "./Newsletter";
import Services from "./Services";
import Whoami from "./Whoami";
import Steps from "./Steps";
import Pricing from "./Pricing";
import Contact from "./Contact";
import Footer from "./Footer";
export default {
    components: {
        Newsletter,
        Hero,
        Services,
        Whoami,
        Steps,
        Pricing,
        Contact,
        Footer
    },

    data () {
        return {
            showPrices: false,
        }
    },

    mounted() {

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Scrollspy
        const section = document.querySelectorAll('section');
        let sections = {};
        let i = 0;

        Array.prototype.forEach.call(section, (e) => {
            sections[e.id] = e.offsetTop;
        })

        window.onscroll = () => {
            let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
            for (i in sections) {
                if (sections[i] <= scrollPosition && i !== 'newsletter') {
                    document.querySelector('.text-black.font-bold').classList.remove('text-black', 'font-bold');
                    document.querySelector('a[href*=' + i + ']').classList.add('text-black', 'font-bold')
                }
            }
        }
        // End scrollspy
    },

    methods: {
        displayResponsiveMenu () {
            const navMenu = document.querySelector('#nav-content');
            if (navMenu.classList.contains('hidden')) {
                navMenu.classList.remove('hidden');
            } else {
                navMenu.classList.add('hidden');
            }
        }
    }
}
</script>
