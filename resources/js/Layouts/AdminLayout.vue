<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/dashboard">
                                <jet-application-mark class="block h-9 w-auto" />
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link href="/admin/dashboard" :active="$page.currentRouteName === 'dashboard'">
                                Tableau de bord
                            </jet-nav-link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link
                                href="/admin/prestations"
                                :active="['activity.all', 'activity.create', 'activity.edit'].includes($page.currentRouteName)"
                            >
                                Prestations
                            </jet-nav-link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link href="/admin/categories" :active="$page.currentRouteName === 'category.all'">
                                Categories
                            </jet-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.first_name + ' ' + $page.user.last_name" />
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Gestion du compte
                                    </div>

                                    <jet-dropdown-link href="/user/profile">
                                        Profil
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Prestations
                                    </div>

                                    <jet-dropdown-link href="/admin/categories">
                                        Catégories
                                    </jet-dropdown-link>

                                    <jet-dropdown-link href="/admin/prestations">
                                        Prestations
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Utilisateurs
                                    </div>

                                    <jet-dropdown-link href="/user/profile">
                                        Tous les utilisateurs
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Paramètres
                                    </div>
                                    <jet-dropdown-link href="/user/profile">
                                        Paramètres généraux
                                    </jet-dropdown-link>
                                    <jet-dropdown-link href="/admin/editer-accueil">
                                        Éditer la page d'accueil
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Déconnexion
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link href="/admin/dashboard" :active="$page.currentRouteName === 'dashboard'">
                        Tableau de bord
                    </jet-responsive-nav-link>
                </div>

                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link
                        href="/admin/prestations"
                        :active="['activity.all', 'activity.create', 'activity.edit'].includes($page.currentRouteName)"
                    >
                        Prestations
                    </jet-responsive-nav-link>
                </div>

                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link href="/admin/categories" :active="$page.currentRouteName === 'category.all'">
                        Categories
                    </jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">{{ $page.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link href="/user/profile" :active="$page.currentRouteName === 'profile.show'">
                            Profil
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <alert-bag v-if="$page.errors.type" :type="$page.errors.type" :title="$page.errors.title" :message="$page.errors.msg" />
                    <alert-bag v-if="$page.flash.success" :type="'success'" :title="'Opération réussie'" :message="$page.flash.success" />
                </div>
                <slot></slot>
            </div>
        </main>
    </div>
</template>

<script>
import JetApplicationLogo from './../Jetstream/ApplicationLogo'
import JetApplicationMark from './../Jetstream/ApplicationMark'
import JetDropdown from './../Jetstream/Dropdown'
import JetDropdownLink from './../Jetstream/DropdownLink'
import JetNavLink from './../Jetstream/NavLink'
import JetResponsiveNavLink from './../Jetstream/ResponsiveNavLink'
import AlertBag from "../Jetstream/AlertBag";

export default {
    components: {
        JetApplicationLogo,
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        AlertBag,
    },

  data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        logout() {
            axios.post('/logout').then(response => {
                window.location = '/';
            })
        },
    },

    computed: {
        path() {
            return window.location.pathname
        }
    }
}
</script>
