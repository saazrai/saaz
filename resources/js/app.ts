import './bootstrap';
import '../css/app.css';
import '../css/theme.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { createPinia } from 'pinia';
import { initializeTheme } from './config/theme';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => {
        // For V1, exclude certain admin pages that aren't ready yet
        const excludedPages = [
            'Admin/Analytics/Dashboard',
            'Admin/Telescope',
            'Admin/Diagnostics/Quality/Index'
        ];
        
        if (excludedPages.includes(name)) {
            console.warn(`Page ${name} is not available in V1`);
            return resolvePageComponent('./pages/Admin/Dashboard.vue', import.meta.glob<DefineComponent>('./pages/**/*.vue'));
        }
        
        return resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue'));
    },
    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
