window.axios = require('axios');

const Vue = require('vue');

import {createApp} from 'vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
import ListaFotografo from './views/ListaFotografo.vue'

const app = createApp({
    components: {
        'lista-fotografos': ListaFotografo,
        VueperSlides, 
        VueperSlide
    }
});

app.mount("#app");