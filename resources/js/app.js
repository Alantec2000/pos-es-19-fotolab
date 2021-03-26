window.axios = require('axios');

const Vue = require('vue');

import {createApp} from 'vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
import ListaFotografo from './views/ListaFotografo.vue'
import Portfolio from './views/Portfolio.vue'
import Toaster from "@meforma/vue-toaster";

const app = createApp({
    components: {
        'lista-fotografos': ListaFotografo,
        VueperSlides,
        VueperSlide,
        Portfolio
    }
});

app.mount("#app");
app.use(Toaster, {
    position: 'top-right',
    duration: 13000,
    maxToasts: 3,
    queue: true
});

window.Vue = Vue;
window.app = app;