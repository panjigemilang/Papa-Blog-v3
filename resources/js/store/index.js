import Vue from "vue";
import Vuex from "vuex";
import general from './modules/general';
import services from "./modules/services";
import posts from "./modules/posts"
import tags from "./modules/tags"

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
    modules: {
        general,
        services,
        posts,
        tags
    }
});
