import VueRouter from "vue-router";
import router from "./routes/front-router";
import SweetAlert from "./helpers/SweetAlert";
import AppStorage from "./helpers/AppStorage";
import Auth from "./helpers/Auth";
import Helper from "./helpers/Helper";
import Swal from "sweetalert2";

import Front_Include_Menu from "./components/front/includes/Front_Include_Menu";
import moment from "moment-jalaali";

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueRouter);
window.SweetAlert = SweetAlert
window.AppStorage = AppStorage
window.Auth = Auth
window.Swal = Swal
window.Helper = Helper

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

//Filters
Vue.filter('filter_date', function (value,format) { return moment(value).format(format='jYYYY/jM/jD')  })
Vue.filter('filter_size', function (value,format='m') {
    let result=0;
    if (format === 'k'){
        result = value/1024;
    }else if (format === 'm'){
        result = value/1024/1024;
    }else if (format === 'g'){
        result = value/1024/1024/1024;
    }else {
        result = value/1024;
    }
    return Math.round( result * 10 ) / 10
})

const app = new Vue({
    el: '#app',
    components :{
      "front-include-menu" : Front_Include_Menu,

    },
    router : router,
});
