import './bootstrap';
import 'bootstrap';

import { createApp, h, watch } from 'vue';
import { createInertiaApp, usePage } from '@inertiajs/vue3';
import { createI18n } from 'vue-i18n';

import LayoutSite from './Layouts/LayoutSite.vue';

import { ZiggyVue } from 'ziggy';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';

library.add(fas, fab, far);

let i18n;

createInertiaApp({
    title: title => `HextechPlay - ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const importPage = pages[`./Pages/${name}.vue`];
        if (!importPage) throw new Error(`Page not found: ./Pages/${name}.vue`);
        return importPage().then(module => {
            module.default.layout = LayoutSite;
            return module;
        });
    },
    setup({ el, App, props, plugin }) {
        const initialLocale = props.initialPage.props.locale;
        const translations = {
            ...props.initialPage.props.translations.site,
            ...props.initialPage.props.translations.page,
        };

        // Cria o i18n uma única vez
        if (!i18n) {
            i18n = createI18n({
                legacy: false,
                globalInjection: true,
                locale: initialLocale,
                messages: {
                    [initialLocale]: translations,
                },
            });
        } else {
            i18n.global.locale.value = initialLocale;
            i18n.global.setLocaleMessage(initialLocale, translations);
        }

        createApp({ render: () => h(App, props) })
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(ZiggyVue)
            .use(plugin)
            .use(i18n)
            .mount(el);

        const page = usePage();
        watch(
            () => page.props,
            (newProps) => {
                const translations = {
                    ...newProps.translations.site,
                    ...newProps.translations.page,
                };
                i18n.global.setLocaleMessage(newProps.locale, translations);
                i18n.global.locale.value = newProps.locale;
            },
            { deep: true, immediate: true }
        );
    },
    progress: {
        color: '#0B0F14',
    }
});
