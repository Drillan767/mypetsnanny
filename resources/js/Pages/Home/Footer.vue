<template>
    <footer class="bg-white">
        <div class="container mx-auto px-8">

            <div class="w-full flex flex-col md:flex-row py-6">

                <div class="flex-1 mb-6">

                    <a class="text-orange-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="/">
                        <img src="logo-horizontal.png" alt="logo" class="h-8 fill-current inline" />
                    </a>
                </div>

                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Legal</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <inertia-link href="/mentions-legales" class="no-underline hover:underline text-gray-800 hover:text-orange-500">
                                Mentions légales
                            </inertia-link>
                        </li>
                        <!--<li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#" class="no-underline hover:underline text-gray-800 hover:text-orange-500">Privacy</a>
                        </li>-->
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Réseaux sociaux</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://www.facebook.com/mypetsnannygrenoble/" class="no-underline hover:underline text-gray-800 hover:text-orange-500">
                                Facebook
                            </a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="https://www.instagram.com/mypetsnanny_/" class="no-underline hover:underline text-gray-800 hover:text-orange-500">
                                Instagram
                            </a>
                        </li>
                        <!--<li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#" class="no-underline hover:underline text-gray-800 hover:text-orange-500">Twitter</a>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {}
</script>
