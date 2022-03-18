<template>
    <div>
        <manage_title title="جشنواره ها"></manage_title>
        <div class="card">
            <div class="card-header">
                <div class="font-16 text-bold-2 text-danger">
                    برگزاری جشنواره جدید
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label >انتخاب دسته بندی</label>
                            <v-select dir="rtl" placeholder="یک دسته بندی را انتخاب کنید" v-model="form.festival_category_id" :options="categories" :reduce="item => item.id" label="name"></v-select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'festival_category_id')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>انتخاب کاربر</label>
                            <v-select dir="rtl"  placeholder="کاربر مورد نظر را انتخاب کنید" v-model="form.user_id" :options="users" :reduce="item => item.id" label="name"></v-select>

                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'user_id')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>نام جشنواره</label>
                            <input v-model="form.title" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'title').length}">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'title')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>لینک جشنواره</label>
                            <input v-model="form.slug" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'slug').length}">
                            <div class="mt-2  font-14" dir="ltr">
                                https://festika.ir/<span class="text-info">{{form.slug}}</span>
                            </div>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'slug')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label>توضیح مختصر در مورد جشنواره</label>
                            <input v-model="form.subtitle" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'subtitle').length}">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'subtitle')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>تصویر لوگو</label>
                            <input @change="PhotoSave" type="file" class="form-control" >
                            <div v-if="form.logo" class="mt-3">
                                <img :src="form.logo" width="70" height="70" alt="">
                                <button @click="RemoveSelectPhoto" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>تصویر پوستر (بنر)</label>
                            <input @change="PhotoSaveBanner" type="file" class="form-control" >
                            <div v-if="form.banner" class="mt-3">
                                <img :src="form.banner" width="70" height="70" alt="">
                                <button @click="RemoveSelectPhotoBanner" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>فایل های قابل ارسال در جشنواره</label>
                            <v-select dir="rtl" placeholder="نوع فایل های قابل ارسال را انتخاب کنید" label="name" :reduce="item => item.val"  multiple v-model="form.formats" :options="format_options" ></v-select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'formats')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>محدودیت ارسال آثار برای هر کاربر</label>
                            <input v-model="form.sends" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'sends').length}">
                            <div class="text-secondary">
                                برای نامحدود کردن تعداد ارسال، این قسمت را خالی بگذارید
                            </div>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'sends')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label  class="form-label">حافظه مورد نظر برای این جشنواره</label> <span dir="ltr" class="float-end"> <i class="mdi mdi-harddisk font-40 text-success"></i>  <span class="me-1 text-danger font-16 text-bold-3">{{ form.disk }} GB</span></span>
                            <input type="range" v-model="form.disk" class="form-range bg-blue p-3 rounded" min="1" max="100" >
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>دوره برگزاری جشنواره ( روز )</label>
                            <input v-model="form.period" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'period').length}" min="10">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'period')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>کل آثار ارسالی در جشنواره </label>
                            <input v-model="form.quantity" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'quantity').length}">
                            <div class="text-secondary">
                                برای نامحدود کردن تعداد کل آثار، این قسمت را خالی بگذارید
                            </div>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'quantity')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>تاریخ شروع جشنواره </label>
                            <date-picker  format="YYYY-MM-DD" v-model="form.start_at" color="#5c6bc0"></date-picker>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'start_at')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>این جشنواره ویژه است ؟ </label>
                            <select v-model="form.is_special" class="form-control">
                                <option value="0">خیر</option>
                                <option value="1">بله</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label>توضیحات کامل در مورد جشنواره </label>
                            <tinyeditor v-model="form.description" api-key="pt855e3h7yxtda2zr97ldurjwwrotxv1gmy7afdhxegvcpu9" :init="{
                                plugins: 'code image link lists hr image media paste preview print table',
                                toolbar:'code image media link table print preview paste fullscreen hr',
                                // language: 'fa_IR',
                                directionality : 'rtl',
                                height:400,
                            }" />

                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label>قوانین و مقررات جشنواره </label>
                            <tinyeditor v-model="form.terms" api-key="pt855e3h7yxtda2zr97ldurjwwrotxv1gmy7afdhxegvcpu9" :init="{
                                plugins: 'code image link lists hr image media paste preview print table',
                                toolbar:'code image media link table print preview paste fullscreen hr',
                                // language: 'fa_IR',
                                directionality : 'rtl',
                                height:400,

                            }" />

                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button @click="FormSubmit" type="button" class="btn btn-primary waves-effect  waves-light font-15"><i v-if="formloading == false" class="fas fa-check "></i> <i v-else class="fas fa-spinner fa-spin"></i> برگزاری جشنواره جدید</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Manage_Title from "../Manage_Title";
import Editor from '@tinymce/tinymce-vue';

export default {
    components : {
        'manage_title' : Manage_Title,
        'tinyeditor' : Editor,

    },
    created() {
        this.GetAllCategories();
        this.GetAllUsers();

        $( document ).ready(function() {

        });

    },
    data(){
        return {
            categories : [],
            format_options: [
                { name: 'عکس', val: 'image' },
                { name: 'ویدئو', val: 'video' },
                { name: 'متنی', val: 'text' },
                { name: 'صوتی', val: 'voice' },
                { name: 'فشرده', val: 'zip' },
            ],
            users : [],
            form : {
                festival_category_id : null,
                user_id : null,
                title : null,
                subtitle : null,
                slug : null,
                description : null,
                terms : null,
                logo : null,
                banner : null,
                sends : null,
                formats : null,
                commenting : 1,
                is_special : 0,
                disk : 1,
                quantity : 10000,
                period : 10,
                start_at : null,
            },
            errors : {},
            formloading : false,
        }
    },
    methods : {

        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/manage/festivals/store',this.form).then(response=>{
                this.$router.push({name : 'manage_festivals'});
                SweetAlert.SweetToastMessage(response.data)
            }).catch(error => {
                if (error.response.status === 421){
                    this.errors = error.response.data
                }else {
                    SweetAlert.SweetServerErrorMessage()
                }
            })
            this.formloading = false;

        },
        GetAllCategories(){
            axios.get('/api/helpers/get/festival/categories').then(response=>{
                this.categories = response.data

            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        GetAllUsers(){
            axios.get('/api/manage/users/members').then(response=>{
                this.users = response.data;
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        PhotoSave(e){
            let file = e.target.files[0];

            if ( file.type !== 'image/jpeg' && file.type !== 'image/png'){
                SweetAlert.SweetToastMessage('فایل انتخابی باید یک تصویر باشد','error')
            }else if (file.size > 1048576){
                SweetAlert.SweetToastMessage('حجم فایل انتخابی باید کمتر از ۱ مگابایت باشد','error')
            }else {
                let reader = new FileReader();
                reader.onload  = e =>{
                    this.form.logo = e.target.result
                };
                reader.readAsDataURL(file)
            }
        },
        RemoveSelectPhoto(){
            this.form.logo = null;
        },

        PhotoSaveBanner(e){
            let file = e.target.files[0];

            if ( file.type !== 'image/jpeg' && file.type !== 'image/png'){
                SweetAlert.SweetToastMessage('فایل انتخابی باید یک تصویر باشد','error')
            }else if (file.size > 1048576){
                SweetAlert.SweetToastMessage('حجم فایل انتخابی باید کمتر از ۱ مگابایت باشد','error')
            }else {
                let reader = new FileReader();
                reader.onload  = e =>{
                    this.form.banner = e.target.result
                };
                reader.readAsDataURL(file)
            }
        },
        RemoveSelectPhotoBanner(){
            this.form.banner = null;
        }
    }
}
</script>

<style scoped>

</style>
