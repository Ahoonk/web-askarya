import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

const aosOptions = {
    once: true,
    duration: 950,
    easing: 'ease-out-cubic',
    offset: 120,
    mirror: false,
};

const refreshAos = () => {
    requestAnimationFrame(() => {
        AOS.refreshHard();
    });
};

createInertiaApp({
    title: (title) => title || 'Aldera Saddatech Karya',
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) }).use(plugin).mount(el);
        AOS.init(aosOptions);
        refreshAos();
    },
    progress: {
        color: '#38bdf8',
    },
});

router.on('navigate', refreshAos);
