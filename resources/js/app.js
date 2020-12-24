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
import VueRouter from 'vue-router'
import router from './routes'
import CKEditor from '@ckeditor/ckeditor5-vue';
import App from './App.vue'
import "../css/app.css"

Vue.use(VueRouter)
Vue.use(CKEditor);
 
const vm = new Vue({
    el: '#root',
    router,
    store,
    render: h => h(App)
})