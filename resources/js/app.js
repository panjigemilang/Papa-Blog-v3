import axios from "axios"

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

import Vue from 'vue'
import store from './store'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './routes'
import wysiwyg from "vue-wysiwyg";
import VueCarousel from '@chenfengyuan/vue-carousel';
import { Fragment } from 'vue-fragment'
import "vue-wysiwyg/dist/vueWysiwyg.css";

Vue.use(wysiwyg, {
    forcePlainTextOnPaste: true,
});
Vue.use(VueCarousel);
Vue.use(Fragment)
Vue.use(VueRouter)
 
const vm = new Vue({
    el: '#root',
    router,
    store,
    render: h => h(App)
})