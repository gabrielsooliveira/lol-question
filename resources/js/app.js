import './bootstrap';
import 'bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createI18n } from 'vue-i18n';

import LayoutSite from './Layouts/LayoutSite.vue';

import { ZiggyVue } from 'ziggy';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';

let i18n;

library.add(fas, fab, far);

createInertiaApp({
    title: title => `HextechPlay - ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const resolvePageComponent = (name, pages) => {
            const importPage = pages[`./Pages/${name}.vue`];
            if (!importPage) {
                throw new Error(`Page not found: ./Pages/${name}.vue`);
            }
            return importPage();
        };
        const page = resolvePageComponent(name, pages);
        page.then(module => {
            module.default.layout = LayoutSite;
        });
        return page;
    },
    setup({ el, App, props, plugin }) {
        if (!i18n) {
            i18n = createI18n({
                locale: props.initialPage.props.locale,
                messages: { [props.initialPage.props.locale]: props.initialPage.props.translations }
            });
        } else {
            i18n.global.locale = props.initialPage.props.locale;
            i18n.global.setLocaleMessage(props.initialPage.props.locale, props.initialPage.props.translations);
        }

        createApp({ render: () => h(App, props) })
        .component('font-awesome-icon', FontAwesomeIcon)
        .use(ZiggyVue)
        .use(plugin)
        .use(i18n)
        .mount(el)
    },
    progress: {
        color: '#0B0F14',
    }
});
