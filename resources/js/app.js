import './modules/bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import Store from './store/store';
import Router from './modules/router';
import i18n, { initI18n } from './i18n';
import "bootstrap/dist/js/bootstrap.js"

async function init() {
    await initI18n();

    const app = createApp(App);
    app.use(i18n);
    app.use(Router);
    app.use(Store);
    app.mount('#app');
}

init();
