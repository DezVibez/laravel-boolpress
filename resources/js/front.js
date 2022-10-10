

require('./bootstrap');

window.Vue = require('vue');

import router from './router.js';

import image_preview from './image_preview.js';

import App from './components/App.vue';

const root = new Vue({
    el: '#root',
    render: h => h(App),
    router: router
});