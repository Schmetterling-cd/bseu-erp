import './modules/bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import Store from './store/store';
import Router from './modules/router';

const app = createApp(App);
app.use(Router);
app.use(Store);
app.mount('#app');

import "bootstrap/dist/js/bootstrap.js"
