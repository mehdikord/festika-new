<template>

<div>
    <div class="inner-banner inner-bg4 app-fade-in">
        <div class="container">
            <div class="inner-title">
                <h1 class="text-aviny text-light font-50">ورود به حساب کاربری</h1>
                <ul>
                    <li>
                        <router-link :to="{name : 'front_index'}">
                            <a>صفحه اصلی</a>
                        </router-link>
                    </li>
                    <li>ورود به حساب</li>
                </ul>
                <div class="inner-shape">
                    <img src="template/images/inner-banner/inner-shape1.png" alt="Images">
                    <img src="template/images/inner-banner/inner-shape2.png" alt="Images">
                </div>
            </div>
        </div>
    </div>
    <div class="user-area pt-100 pb-70 app-fade-in">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="user-all-form">
                        <div v-if="showAuth === false" class="contact-form">
                            <h3> ورود به حساب کاربری فستیکا</h3>
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group">
                                        <label>شماره موبایل </label>
                                        <input v-model="form.phone" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors, 'phone').length}">
                                        <div v-for="(error,index) in this.ValidationErrors(errors,'phone')" :key="index" class="font-12 text-danger">
                                            {{ error }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-condition">

                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button @click="FormSubmit" type="submit" class="default-btn">
                                        ورود به حساب
                                    </button>
                                </div>
                                <div class="col-12">
                                    <div class="sub-title">
                                        <span>یا</span>
                                    </div>
                                </div>
                                <div class="login-with-account">
                                   <div class="text-center">
                                       <router-link :to="{name:'front_register'}">
                                       <a class="">
                                           اگر حساب ندارید، ثبت نام کنید
                                       </a>
                                       </router-link>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="contact-form">

                            <h4> کد تایید را وارد کنید </h4>
                            <div class="bar mt-3"></div>
                            <div class="row">
                                <div class="col-12 mb-5">
                                    جهت تکمیل ورود، کد تایید ارسال شده به شماره موبایلتان را وارد کنید
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>کد تایید :</label>
                                        <input v-model="code" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors, 'code').length}" required >
                                        <div v-for="(error,index) in this.ValidationErrors(errors,'code')" :key="index" class="font-12 text-danger">
                                            {{ error }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 text-center">
                                    <button class="default-btn" @click="CodeFromSubmit">
                                        ارسال کد تائید
                                    </button>
                                </div>
                                <div class="col-12">
                                    <div class="sub-title">
                                        <span>یا</span>
                                    </div>
                                </div>
                                <div class="login-with-account">
                                    <ul>
                                        <li class="text-center text-secondary">
                                            تغییر شماره موبایل
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import AppStorage from "../../helpers/AppStorage";
import Auth from "../../helpers/Auth";

export default {
    name: "Front_Login",
    data(){
        return {
            form : {
                phone : null,
            },
            code:null,
            errors : {},
            showAuth : false,
        }
    },
    methods : {
        FormSubmit(){
            this.errors = {};
            axios.post('/api/auth/login',this.form).then(response => {
                if (response.data){
                    AppStorage.AppStorageSetItem('pre_login_user',response.data)
                    SweetAlert.SweetToastMessage('کد تایید به شماره شما ارسال شد')
                    this.showAuth = true
                }else{
                    SweetAlert.SweetServerErrorMessage();
                }
            }).catch(error => {
                if (error.response.status === 421){
                    this.errors = error.response.data;
                }else if (error.response.status === 409){
                    SweetAlert.SweetAlertMessage(error.response.data,'','error');
                }
                else {
                    SweetAlert.SweetServerErrorMessage();
                }
            })

        },
        CodeFromSubmit(){
            this.errors={};

            axios.post('/api/auth/login/check',{'code' : this.code,phone: localStorage.getItem('pre_login_user')}).then(response =>{
                if (response.data.user && response.data.access_token){
                    localStorage.removeItem('pre_login_user');
                    Auth.AuthLoginUser(JSON.stringify(response.data.user),response.data.access_token);
                    SweetAlert.SweetToastMessage('باموفقیت وارد حسابتان شدید');
                    setTimeout(() => {
                        window.open('/','_self');
                    }, 1500)
                }else{
                    SweetAlert.SweetServerErrorMessage();
                }
            }).catch(error=>{
                if (error.response.status === 411){
                    SweetAlert.SweetToastMessage(error.response.data,'error');
                }else if (error.response.status === 410 ){
                    SweetAlert.SweetAlertMessage(error.response.data,'','error');
                    this.code=null;
                }else if (error.response.status === 421 ){
                    this.errors = error.response.data;
                }else {
                    SweetAlert.SweetServerErrorMessage();
                }
            })
        }
    },
    created() {
        if (Auth.AuthCheck()){
            this.$router.push({name : 'front_index'})
        }
        if (localStorage.getItem('pre_login_user')){
            this.showAuth = true;
        }
    }
}
</script>

<style scoped>

</style>
