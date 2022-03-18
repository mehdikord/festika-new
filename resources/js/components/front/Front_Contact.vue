<template>

    <div>
        <div class="inner-banner inner-bg12">
            <div class="container">
                <div class="inner-title">
                    <h1 class="text-aviny text-light font-50">ارتباط با ما</h1>
                    <ul>
                        <li>
                            <router-link :to="{name : 'front_index'}">
                               صفحه اصلی
                            </router-link>
                        </li>
                        <li>ارتباط با ما</li>
                    </ul>
                    <div class="inner-shape">
                        <img src="template/images/inner-banner/inner-shape1.png" alt="Images">
                        <img src="template/images/inner-banner/inner-shape2.png" alt="Images">
                    </div>
                </div>
            </div>
        </div>



        <div class="contact-info-area pt-100 pb-70 app-fade-in">
            <div class="container">
                <div class="section-title text-center">
                    <h1 class="text-aviny font-50">راه های ارتباطی برای تماس با ما
                    </h1>
                    <p class="text-danger">
                        تماس تلفنی فقط در روز های (شنبه تا چهارشنبه)
                        <br>
                        و در ساعات ( ۱۰ الی 17 )
                    </p>
                </div>
                <div class="row pt-45 justify-content-center">

                    <div class="col-lg-4 col-6">
                        <div class="contact-card">
                            <i class="fas fa-phone font-25"></i>
                            <h3>تلفن تماس</h3>
                            <p><a href="tel:09219689695">0921-968-96952</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="contact-card">
                            <i class="fas fa-envelope-circle-check font-25"></i>
                            <h3>ارسال ایمیل</h3>
                            <p><a href="mail:festikahelp@gmail.com">
                                festikahelp@gmail.com
                            </a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="contact-area pb-70 app-fade-in">
            <div class="section-title text-center mb-5">
                <h1 class="text-aviny font-50">
                    ارسال پیام به تیم فستیکا
                </h1>
                <p class="">
                    کاربر گرامی، شما میتوانید پیام ها، انتقادات و پیشنهادات خود را از طریق فرم زیر برای فستیکا ارسال کنید.
                    پیام های شما توسط کارشناسان بررسی شده و در صورت نیاز با شما تماس گرفته میشود.
                </p>
            </div>

            <div class="container">
                <div class="contact-form shadow">
                    <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>نام کامل</label>
                                    <input v-model="form.name" type="text" class="form-control" required :class="{'is-invalid' : this.ValidationErrors(errors,'name').length}">
                                    <div class="help-block with-errors mb-2" v-for="(error,index) in this.ValidationErrors(errors,'name')" :key="index">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>شماره تماس</label>
                                    <input v-model="form.phone" type="number" class="form-control" required :class="{'is-invalid' : this.ValidationErrors(errors,'phone').length}">
                                    <div class="help-block with-errors mb-2" v-for="(error,index) in this.ValidationErrors(errors,'phone')" :key="index">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>آدرس ایمیل (اختیاری)</label>
                                    <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'email').length}">
                                    <div class="help-block with-errors mb-2" v-for="(error,index) in this.ValidationErrors(errors,'email')" :key="index">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>موضوع پیام (اختیاری)</label>
                                    <input type="text" v-model="form.subject"  class="form-control" required :class="{'is-invalid' : this.ValidationErrors(errors,'subject').length}">
                                    <div class="help-block with-errors mb-2" v-for="(error,index) in this.ValidationErrors(errors,'subject')" :key="index">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>پیام شما</label>
                                    <textarea class="form-control" v-model="form.message" rows="7" required :class="{'is-invalid' : this.ValidationErrors(errors,'message').length}"></textarea>
                                    <div class="help-block with-errors mb-2" v-for="(error,index) in this.ValidationErrors(errors,'message')" :key="index">
                                        {{error}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button @click="FormSubmit" class="default-btn border-radius-5">
                                    ارسال پیام به فستیکا
                                    <i v-if="formloading===false" class="fas fa-rocket font-25"></i>
                                    <i v-else class="fas fa-spin fa-spinner font-25"></i>
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
export default {
    name: "Front_Contact",
    data(){
        return {
            formloading : false,
            errors : {},
            form : {
                name:null,
                phone:null,
                email:null,
                subject:null,
                message:null,
            }
        }
    },
    methods :{

        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/front/contact/message/send',this.form).then(response=>{
                SweetAlert.SweetAlertMessage(response.data,'','success')
                this.form = {};
            }).catch(error => {
                if (error.response.status === 421){
                    this.errors = error.response.data
                }else {
                    SweetAlert.SweetServerErrorMessage()
                }
            })
            this.formloading = false;

        },

    }
}
</script>

<style scoped>

</style>
