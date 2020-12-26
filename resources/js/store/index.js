import Vue from "vue";
import Vuex from "vuex";
import general from './modules/general';
import services from "./modules/services";

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
    modules: {
        general,
        services
    }
});
