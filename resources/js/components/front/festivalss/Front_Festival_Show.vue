<template>
    <div>
        <div class="inner-banner inner-bg-festivals app-fade-in">
            <div class="container">
                <div class="inner-title">
                    <h1 class="text-aviny text-light font-50">
                        <span v-if="festival !== null">{{festival.title}}</span>
                    </h1>
                    <ul>
                        <li>
                            <router-link :to="{name : 'front_index'}" class="text-light">
                                صفحه اصلی
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{name : 'front_festivals'}" class="text-light">
                                همه جشنواره ها
                            </router-link>
                        </li>
                        <li v-if="festival !== null">
                            {{festival.title}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="item-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 app-fade-in">
                        <div class="item-details-left-side pr-20">
                            <div class="item-details-img">
                                <img width="100%" v-if="festival !== null && festival.banner !== null" :src="festival.banner" alt="">
                                <img width="100%" v-else src="/template/images/svg/festika-banner.jpg" alt="">
                            </div>
                            <div class="mt-3" v-if="festival !== null && festival.sponsors.length > 0">
                                <h6 class="font-16">حامیان این جشنواره</h6>
                                <div class="mt-4 row">
                                    <div v-for="(sponsor,index) in festival.sponsors" :key="index" class="col-md-4 col-sm-6 mt-2 text-center">
                                        <img class="img-logo" v-if="sponsor.logo !== null" :src="sponsor.logo" alt="sponsor">
                                        <img class="img-logo" v-else src="/template/images/svg/sponsor-default.png" alt="sponsor">
                                        <h6 class="mt-2">{{sponsor.name}}</h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 app-fade-in">
                        <div class="item-details-dsce">
                            <div class="section-title img-fluid app-fade-in">
                                <img class="img-logo" v-if="festival !== null && festival.logo !== null" :src="festival.logo" alt="">
                                <img class="img-logo" v-else src="/template/images/svg/default-logo.png"  alt="">
                                <span v-if="festival !== null" class="font-18 mr-2 text-bold-3 text-dark">{{ festival.title}}</span>
                            </div>
                            <div class="mb-4 app-fade-in">
                                <span v-if="festival !== null && festival.category !== null" class=" badge bg-teal3 font-14 text-light">{{festival.category.name}}</span>
                            </div>
                            <div class="section-title mb-5 app-fade-in">
                                <h6 class="text-secondary">توضیح مختصر :</h6>
                                <p v-if="festival !== null">
                                    {{ festival.subtitle }}
                                </p>
                            </div>

                            <div class="row app-fade-in">
                                <div class="col-lg-6 col-6">
                                    <div class="item-details-user">
                                        <h6 class="text-secondary">برگزار کننده :</h6>
                                        <div class="content">
                                            <div class="images">
                                                <img class="border-0" v-if="festival !== null && festival.user.profile !== null" :src="festival.user.profile"  alt="Images">
                                                <img class="border-0" v-else src="/template/images/svg/user-default.png"  alt="Images">
                                            </div>
                                            <router-link class="text-danger font-14" to="" v-if="festival !== null">{{festival.user.name}}</router-link>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <div class="item-details-user">
                                        <h6 class="text-secondary">تاریخ :</h6>
                                        <div class="content">
                                            <i class="fas fa-calendar font-20 text-info"></i>
                                            <span v-if="festival !== null" class="mr-2 badge bg-green3  font-14 text-light">{{festival.start_at | filter_date()}}</span>
                                            <span class="text-secondary text-bold-3 mr-2 ml-2"> - </span>
                                            <span v-if="festival !== null" class=" badge bg-red3  font-14 text-light">{{festival.expire_at | filter_date()}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-details-price mb-3 app-fade-in">
                                <div class="item-details-title">
                                    <h6 class="text-secondary">آثار قابل ارسال : </h6>
                                </div>
                                <div v-if="formats.length > 0" class="row">
                                    <div  v-for="(format,index) in formats" :key="index" class="col">
                                        <img v-if="format === 'image' " src="/template/images/svg/image-icon.png" width="40">
                                        <img v-if="format === 'video' " src="/template/images/svg/video-icon.png" width="40">
                                        <img v-if="format === 'text' " src="/template/images/svg/text-icon.png" width="40">
                                        <img v-if="format === 'voice' " src="/template/images/svg/voice-icon.png" width="40">
                                        <img v-if="format === 'zip' " src="/template/images/svg/zip-icon.png" width="40">
                                        <span class="text-bold-2 text-danger">{{ format}}</span>

                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div v-if="festival !== null && festival.is_expired === 1">
                                <div class="img-fluid text-center">
                                    <img src="/template/images/svg/expired.svg" width="40%" alt="">
                                    <h6 class="mt-2">
                                        جشنواره مورد نظر به پایان رسیده است، منتظر اعلام نتایج باشید
                                    </h6>

                                </div>
                            </div>
                            <div v-else>
                                <h6 class="text-secondary mb-4">ارسال اثر به جشنواره :</h6>
                                <div v-if="!UserAuthCheck()">
                                    <div class="alert alert-primary font-15">
                                        کاربر گرامی برای ارسال اثر به جشنواره، ابتدا باید وارد حساب کاربری خود شوید
                                        <br>
                                        <br>
                                        برای ورود به حساب کافیست شماره موبایل خود را وارد کنید
                                        <br>
                                        <div class="form-group mt-4 text-center row">
                                            <div class="col-md-8 mt-2 ">
                                                <input v-model="form.phone" class="form-control" type="number">
                                            </div>
                                            <div class="col-md-4 text-right mt-2">
                                                <button @click="FormSubmit()" class="btn btn-primary">ورود به حساب</button>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            حساب ندارید ؟
                                            <router-link :to="{name : 'front_register'}" class="text-bold-3 font-16">
                                                ثبت نام کنید
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="forms.length > 0 && UserAuthCheck()" class="mt-3 mb-3">
                                    <div class="alert alert-primary text-center font-14 mb-3">
                                        برای شرکت در جشنواره اطلاعات خواسته شده را کامل کنید
                                    </div>
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div v-for="(form,index) in forms" :key="index" class="form-group mt-4 ">
                                                <label  class="form-label">{{form.form}}</label>
                                                <input v-model="form_answers[form.form]" type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="UserAuthCheck()" class="item-details-in-content ">

                                    <h6 class="text-success text-center font-15 mb-4">انتخاب فایل جهت ارسال</h6>
                                    <div class="form-group">
                                        <input @change="HandleUploadFile" ref="file" type="file" class="form-control">
                                    </div>
                                    <div v-if="selected_file !== null" class=" text-center mt-4">
                                        فایل انتخاب شده : <span class="text-danger text-bold-3">{{selected_file.name}}</span>
                                    </div>
                                </div>
                                <div v-if="UserAuthCheck()" class="item-details-btn">
                                    <button @click="SendFileSubmit" :disabled="selected_file === null" class="default-btn border-radius-50"> ارسال اثر به جشنواره</button>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link  active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                    توضیحات کامل جشنواره
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="terms-tab" data-bs-toggle="tab" data-bs-target="#terms" type="button" role="tab" aria-controls="terms" aria-selected="false">
                                    قوانین و مقررات
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="false">
                                    دیدگاه کاربران
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div v-if="festival !== null" class="mt-5">
                                    <span v-html="festival.description"></span>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                                <div v-if="festival !== null" class="mt-5">
                                    <span v-html="festival.terms"></span>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import SweetAlert from "../../../helpers/SweetAlert";
import AppStorage from "../../../helpers/AppStorage";

export default {
    name: "Front_Festival_Show",

    created() {
        this.GetFestival();
        this.GetFormats();
        this.GetForms();

    },
    data(){
        return {
            festival: null,
            formats : [],
            forms : [],
            mimes : [],
            selected_file : null,
            form_answers:[],
            form : {
                phone : null,
            },
            errors : {},
        }
    },
    methods : {

        GetFestival(){
            axios.get('/api/front/festivals/show/'+this.$route.params.slug).then(response=>{
                this.festival = response.data;
                AppStorage.AppStorageSetItem('festival_visit',this.festival.slug);

            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        GetFormats(){
            axios.get('/api/front/festivals/get/formats/'+this.$route.params.slug).then(response=>{
                this.formats = response.data.formats;
                this.mimes = response.data.mimes;
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        GetForms(){
            axios.get('/api/front/festivals/get/forms/'+this.$route.params.slug).then(response=>{
                this.forms = response.data;
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        FormSubmit(){
            this.errors = {};
            axios.post('/api/auth/login',this.form).then(response => {
                if (response.data){
                    AppStorage.AppStorageSetItem('pre_login_user',response.data)
                    SweetAlert.SweetToastMessage('کد تایید به شماره شما ارسال شد')
                    this.$router.push({name:'front_login'});
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
        SendFileSubmit(){
            // console.log(this.selected_file.file);
            Swal.fire({
                html: '<p class="font-16 text-dark pt-4">کاربر گرامی اثر شما درحال ارسال به جشنواره است، لطفا شکیبا باشید</p> <img class="text-center" src="/template/images/svg/file-submit-loading.svg" width="90%">',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                },
            })
            let formData = new FormData();
            formData.append('selected_file',this.selected_file);
            formData.append('forms',this.form_answers);
            axios.post(
                '/api/panel/submit/form/festival/'+this.festival.slug,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response=>{
                SweetAlert.SweetAlertMessage(response.data,'','success');
                // this.$router.push({name: 'front_festivals'})
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            });

        },
        HandleUploadFile(){
            if (this.$refs.file.files.length > 0){
                this.selected_file=this.$refs.file.files[0];
                if (!this.mimes.includes(Helper.HelperGetFileExtension(this.selected_file.name))){
                    this.selected_file=null;
                    SweetAlert.SweetAlertMessage('فایل انتخاب شده قابل قبول نیست. فایل انتخابی باید یکی از آثار قابل ارسال باشد','','error')
                }
            }

        }



    },
}
</script>

<style scoped>
.img-logo{
    width: 80px!important;
    height: 80px!important;
    border-radius: 50%!important;
    border : 2px solid rgba(255, 84, 53, 0.76);
}
.mr-2{
    margin-right: 8px!important;
}
.ml-2{
    margin-left: 8px!important;
}
.text-center{
    text-align: center!important;
}
</style>
