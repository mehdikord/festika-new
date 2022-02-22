import VueRouter from "vue-router";
import router from "./routes/front-router";

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    router : router,
});
