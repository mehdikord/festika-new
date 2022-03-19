/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueRouter from "vue-router";
import dashboardRouter from "./routes/dashboard-router";
import Panel_Menu from "./components/dashboard/Panel_Menu";
import Auth from "./helpers/Auth";
import SweetAlert from "./helpers/SweetAlert";
import AppStorage from "./helpers/AppStorage";
import Swal from "sweetalert2";
import vSelect from 'vue-select'
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import moment from "moment-jalaali";

require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter);

window.Swal = Swal
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
        window.open('/login','_self');
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
        },
    }
});

Vue.component('v-select', vSelect);
Vue.component('date-picker', VuePersianDatetimePicker);

const app = new Vue({
    el: '#app',
    router : dashboardRouter,
    components :{
        'panel-menu' : Panel_Menu,
    }
});
