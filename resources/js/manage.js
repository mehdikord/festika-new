
import VueRouter from "vue-router";
import manageRouter from "./routes/manage-router";
import Manage_Menu from "./components/manage/Manage_Menu";
import Manage_Header from "./components/manage/Manage_Header";
import Auth from "./helpers/Auth";
import SweetAlert from "./helpers/SweetAlert";
import AppStorage from "./helpers/AppStorage";
import Swal from "sweetalert2";
import vSelect from 'vue-select'
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import moment from "moment-jalaali";

window.Swal = Swal
require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(VueRouter)
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
        NumberToEn(number) {
            let find = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            let replace = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            let replaceString = number;
            let regex;
            for (let i = 0; i < find.length; i++) {
                regex = new RegExp(find[i], "g");
                replaceString = replaceString.replace(regex, replace[i]);
            }
            return replaceString;
        }

    }
})

Vue.component('v-select', vSelect)
Vue.component('date-picker', VuePersianDatetimePicker);


//Filters
Vue.filter('filter_date', function (value,format) { return moment(value).format(format='jYYYY/jM/jD')  })

const app = new Vue({
    el: '#app',
    router : manageRouter,
    components : {
        'manage_menu' : Manage_Menu,
        'manage_header' : Manage_Header,
    },
});
