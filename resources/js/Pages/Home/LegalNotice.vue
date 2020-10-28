<template>
    <div>
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
                            <a class="active inline-block py-2 px-4 text-black font-bold no-underline" href="/#accueil">Accueil</a>
                        </li>
                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="/#services">Services</a>
                        </li>
                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="/#presentation">Qui suis-je ?</a>
                        </li>

                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="/#fonctionnement">Comment ça marche ?</a>
                        </li>

                        <li class="mr-3">
                            <a class="inline-block text-black hover:text-gray-800 py-2 px-4" href="/#contact">Contact</a>
                        </li>
                    </ul>
                    <div class="block text-center lg:inline-block">
                        <a href="/login" class="landing-button">
                            Connexion
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
        </nav>

        <div class="container mx-auto mt-6 pt-6">
            <div class="column is-8 is-offset-2">
                <h3 class="w-full my-8 text-5xl font-bold leading-tight text-center text-gray-800">Mentions legales</h3>

                <h4 class="text-3xl text-gray-800 font-bold leading-none mb-3">MENTIONS LÉGALES DU SITE</h4>

                <p class="mb-4">de My Pet's Nanny</p>

                <p class="mb-4">
                    Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la
                    Confiance dans l'économie numérique, dite L.C.E.N., il est porté à la connaissance des
                    utilisateurs et visiteurs du site My Pet's Nanny les présentes mentions légales.
                </p>
                <p class="mb-4">
                    Le site My Pet's Nanny est accessible à l'adresse suivante :<br />
                    https://mypetsnanny.fr
                </p>
                <p class="mb-4">
                    L'accès et l'utilisation du Site sont soumis aux présentes " Mentions légales" détaillées ci-après ainsi
                    qu'aux lois et/ou règlements applicables.
                </p>
                <p class="mb-4">
                    La connexion, l'utilisation et l'accès à ce Site impliquent l'acceptation intégrale et sans réserve de
                    l'internaute de toutes les dispositions des présentes Mentions Légales.
                </p>

                <h4 class="text-3xl text-gray-800 font-bold leading-none mb-3">ARTICLE 1 - INFORMATIONS LÉGALES</h4>

                <p class="mb-4">
                    En vertu de l'Article 6 de la Loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique,
                    il est précisé dans cet article l'identité des différents intervenants dans le cadre de sa réalisation
                    et de son suivi.
                </p>
                <p class="mb-4">
                    Le site My Pet's Nanny est édité par Joseph Levarato domicilié à l'adresse suivante :
                </p>
                <p class="mb-4">
                    3, rue Renan, et immatriculé au numéro suivant : 818 885 907 00019.
                </p>
                <p class="mb-4">
                    Téléphone : 0675566262
                </p>
                <p class="mb-4">
                    Adresse e-mail : jd.levarato@gmail.com
                </p>

                <p class="mb-4">
                    La Directrice de publication est :<br />

                    Alexandrine Serrano.<br /><br />

                    Le directeur artistique est :<br />

                    Joseph Levarato<br /><br />

                    Adresse e-mail de contact : jlevarato@protonmail.com<br /><br />

                    Le Directeur technique est :<br />

                    Joseph Levarato<br /><br />
                </p>
                <p class="mb-4">
                    Le site My Pet's Nanny est hébergé par OVH dont le siège est situé à l'adresse suivante :
                    2 Rue Kellermann, 59100 Roubaix
                </p>
                <p class="mb-4">
                    Téléphone : 09 72 10 10 07<br />

                    Contact : https://www.ovh.com/fr/support/nous-contacter/.
                </p>
                <p class="mb-4">
                    Sont considérés comme utilisateurs tout les internautes qui naviguent, lisent, visionnent et utilisent
                    le site My Pet's Nanny.
                </p>

                <h4 class="text-3xl text-gray-800 font-bold leading-none mb-3">ARTICLE 2 - ACCESSIBILITÉ</h4>

                <p class="mb-4">
                    Le Site est par principe accessible aux utilisateurs 24/24h et 7/7j, sauf interruption, programmée ou
                    non, pour des besoins de maintenance ou en cas de force majeure.
                </p>
                <p class="mb-4">
                    En cas d'impossibilité d'accès au Site, celui-ci s'engage à faire son maximum afin d'en rétablir l'accès.
                    Le Site ne saurait être tenu pour responsable de tout dommage,quelle qu'en soit la nature, résultant de
                    son indisponibilité.
                </p>

                <h4 class="text-3xl text-gray-800 font-bold leading-none mb-3">ARTICLE 3 - COLLECTE DE DONNÉES ET LOI INFORMATIQUE ET LIBERTÉS</h4>

                <p class="mb-4">
                    Le site My Pet's Nanny est exempté de déclaration à la Commission Nationale Informatique et Libertés
                    (CNIL) dans la mesure où il ne collecte aucune donnée des Utilisateurs.
                </p>

                <h4 class="text-3xl text-gray-800 font-bold leading-none mb-3">ARTICLE 4 - CONTACT</h4>
                <p class="mb-4">
                    Pour tout signalement de contenus ou d'activités illicites, l'Utilisateur peut contacter l'Éditeur à
                    l'adresse suivante : jd.levarato@gmail.com, ou par courrier recommandé avec accusé de réception
                    adressé à l'Éditeur aux coordonnées précisées dans les présentes mentions légales.
                </p>
                <p class="mb-4">
                    Crédits photo : Alexandrine Serrano<br />
                </p>
            </div>
        </div>

        <Footer />

    </div>
</template>

<script>
import VueMeta from 'vue-meta';
import Footer from "./Footer";
export default {
    title: 'Mentions Légales',

    components: {
        VueMeta,
        Footer,
    },

    metaInfo: {
        title: 'Mentions Légales',
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
