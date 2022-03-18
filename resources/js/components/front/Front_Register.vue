<template>
    <div>
        <div class="inner-banner inner-bg5 app-fade-in">
            <div class="container">
                <div class="inner-title">
                    <h1 class="text-aviny text-light font-50">ثبت نام در فستیکا</h1>
                    <ul>
                        <li>
                            <router-link :to="{name : 'front_index'}">
                                <a>صفحه اصلی</a>
                            </router-link>
                        </li>
                        <li>ثبت نام</li>
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
                                <h3> ایجاد حساب در فستیکا </h3>
                                <div class="bar mt-3"></div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>نام</label>
                                                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors, 'name').length}" >
                                                <div v-for="(error,index) in this.ValidationErrors(errors,'name')" :key="index" class="font-12 text-danger">
                                                    {{ error }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <label>شماره موبایل</label>
                                                <input v-model="form.phone" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors, 'phone').length}">
                                                <div v-for="(error,index) in this.ValidationErrors(errors,'phone')" :key="index" class="font-12 text-danger">
                                                    {{ error }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ایمیل</label>
                                                <input v-model="form.email" class="form-control" type="email" placeholder="اختیاری " :class="{'is-invalid' : this.ValidationErrors(errors, 'email').length}">
                                                <div v-for="(error,index) in this.ValidationErrors(errors,'email')" :key="index" class="font-12 text-danger">
                                                    {{ error }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 text-center">
                                            <button class="default-btn" @click="FormSubmit">
                                                ایجاد حساب
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <div class="sub-title">
                                                <span>یا</span>
                                            </div>
                                        </div>
                                        <div class="login-with-account">
                                            <div class="text-center">
                                                <router-link :to="{name:'front_login'}">
                                                    <a class="">
                                                        اگر حساب دارید، وارد شوید
                                                    </a>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div v-else class="contact-form">

                                <h4> تائید شماره موبایل برای ثبت نام </h4>
                                <div class="bar mt-3"></div>
                                <div class="row">
                                    <div class="col-12 mb-5">
                                        جهت تکمیل ثبت نام، کد تایید ارسال شده به شماره موبایلتان را وارد کنید
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
    name: "Front_Register",
    data(){
        return {
            form : {
                name : null,
                phone : null,
                email : null,
            },
            code:null,
            errors : {},
            showAuth : false,
        }
    },
    methods : {
        FormSubmit(){
            this.errors = {};
            axios.post('/api/auth/register',this.form).then(response => {
                if (response.data){
                    AppStorage.AppStorageSetItem('register_user',JSON.stringify(response.data))
                    this.showAuth = true
                }else{
                    SweetAlert.SweetServerErrorMessage();

                }
            }).catch(error => {
                if (error.response.status === 421){
                    this.errors = error.response.data;
                }else {
                    SweetAlert.SweetServerErrorMessage();
                }
            })

        },
        CodeFromSubmit(){
            this.errors={};
            let register_user = JSON.parse(localStorage.getItem('register_user'))
            axios.post('/api/auth/register/check',{'code' : this.code,name:register_user.name,phone:register_user.phone,email:register_user.email}).then(response =>{
                if (response.data.user && response.data.access_token){
                    localStorage.removeItem('register_user');
                    Auth.AuthLoginUser(JSON.stringify(response.data.user,response.data.access_token));
                    SweetAlert.SweetAlertMessage('کاربر گرامی ثبت نام شما در فستیکا با موفقیت انجام شد','','success');
                    setTimeout(() => {
                        window.open('/','_self');
                    }, 3000)
                }else{
                    SweetAlert.SweetServerErrorMessage();

                }
            }).catch(error=>{
                if (error.response.status === 409){
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
        if (localStorage.getItem('register_user')){
            this.showAuth = true;
        }
    }
}
</script>

<style scoped>

</style>
