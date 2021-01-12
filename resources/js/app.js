require('./bootstrap');

import Vue from 'vue';
import titleMixin from "./Mixins/titleMixin";
import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import { VueReCaptcha } from "vue-recaptcha-v3";

const app = document.getElementById('app');

if (app) {
    const initialValues = JSON.parse(app.dataset.page);

    Vue.mixin(titleMixin);
    Vue.use(InertiaApp);
    Vue.use(InertiaForm);
    Vue.use(VueReCaptcha, { siteKey: initialValues.props.recaptcha_key });

    new Vue({
        render: (h) =>
            h(InertiaApp, {
                props: {
                    initialPage: initialValues,
                    resolveComponent: (name) => require(`./Pages/${name}`).default,
                },
            }),
    }).$mount(app);
}
