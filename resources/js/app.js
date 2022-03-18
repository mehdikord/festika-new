import VueRouter from "vue-router";
import router from "./routes/front-router";
import SweetAlert from "./helpers/SweetAlert";
import AppStorage from "./helpers/AppStorage";
import Auth from "./helpers/Auth";

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);
window.SweetAlert = SweetAlert
window.AppStorage = AppStorage
window.Auth = Auth

axios.defaults.headers.common['Authorization'] =  Auth.AuthGetToken();
axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    if (error.response.status ===  401){
        Auth.AuthLogout()
        SweetAlert.SweetAlertMessage('شما از حساب کاربریتان خارج شده اید، لطفا دوباره وارد شوید','','error');
        // return Promise.reject(error);

    }else{
        return Promise.reject(error);
    }
});

Vue.mixin({
    methods : {
        ValidationErrors(errors={},field){
            return errors[field] && errors[field].length ? errors[field] : {};
        },
        UserAuthCheck(){
            return Auth.AuthCheck();
        },
        UserAuthGet() {
            return Auth.AuthGetUser();
        }
    },

})
const app = new Vue({
    el: '#app',
    router : router,
});
