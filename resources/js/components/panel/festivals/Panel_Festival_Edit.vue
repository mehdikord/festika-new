<template>
    <div>
        <panel_title v-if="festival !== null" :title="title"></panel_title>
        <div class="card app-fade-in">
            <div class="card-header">
                <div class="font-16 text-bold-2 text-danger">
                    <div class="alert alert-danger fade show mb-0" role="alert">
                        <img src="/management/images/help.png" class="fa-beat" width="50" alt="">
                        <span class="font-15">کاربر گرامی در این قسمت شما فقط میتوانید اطلاعات جشنواره را ویرایش نمایید لطفا برای ارتقاء منابع (مدت برگزاری ، افزایش فضای ذخیره سازی و ...) به قسمت ارتقاء منابع در صفحه مدیریت جشنواره مراجعه کنید</span>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label >انتخاب دسته بندی</label>
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#collapse_category">
                                <i class="fas fa-question align-middle"></i>
                            </button>
                            <div class="collapse" id="collapse_category">
                                <div class="card card-body bg-success text-light">
                                    دسته بندی جشنواره نشان دهنده نوع جشنواره برای گروه یا سبک خاص است و همچنین در جستجو و یافتن جشنواره کمک میکند.
                                </div>
                            </div>
                            <v-select dir="rtl" placeholder="یک دسته بندی را انتخاب کنید" v-model="form.festival_category_id" :options="categories" :reduce="item => item.id" label="name"></v-select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'festival_category_id')" :key="index">
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
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#collapse_slug">
                                <i class="fas fa-question align-middle"></i>
                            </button>
                            <div class="collapse" id="collapse_slug">
                                <div class="card card-body bg-success text-light">
                                    لینک جنشواره،آدرس نمایش جشنواره شما در پلتفرم فستیکا میباشد که برای دیگران ارسال میکنید.(بهتر است لینک جشنواره را به صورت انگلیسی وارد کنید. مثال : emam-khomeini )
                                </div>
                            </div>

                            <input v-model="form.slug" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'slug').length}">
                            <div class="mt-2  font-14" dir="ltr">
                                https://festika.ir/festivals/show/<span class="text-info">{{form.slug}}</span>
                            </div>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'slug')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>توضیح مختصر در مورد جشنواره</label>
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#collapse_subtitle">
                                <i class="fas fa-question align-middle"></i>
                            </button>
                            <div class="collapse" id="collapse_subtitle">
                                <div class="card card-body bg-success text-light text-bold-2">
                                    توضیح بصورت مختصر و کوتاه. مثال : جشنواره خورشید هشتم بمناسبت تولد امام رضا(ع)
                                </div>
                            </div>
                            <input v-model="form.subtitle" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'subtitle').length}">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'subtitle')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>تصویر لوگو</label>
                            <input @change="PhotoSave" type="file" class="form-control" >
                            <div class="mt-2 text-danger">فقط درصورت ویرایش لوگو فعلی، تصویر جدید را انتخاب کنید</div>
                            <div v-if="form.logo" class="mt-3">
                                <img :src="form.logo" width="70" height="70" alt="">
                                <button @click="RemoveSelectPhoto" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>تصویر پوستر (بنر)</label>
                            <input @change="PhotoSaveBanner" type="file" class="form-control" >
                            <div class="mt-2 text-danger">فقط درصورت ویرایش پوستر فعلی، تصویر جدید را انتخاب کنید</div>

                            <div v-if="form.banner" class="mt-3">
                                <img :src="form.banner" width="70" height="70" alt="">
                                <button @click="RemoveSelectPhotoBanner" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>فایل های قابل ارسال در جشنواره</label>
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#collapse_files">
                                <i class="fas fa-question align-middle"></i>
                            </button>
                            <div class="collapse" id="collapse_files">
                                <div class="card card-body bg-success text-light text-bold-2">
                                    نوع فایل آثار ارسالی به جشنواره است و کاربر نمیتواند بجز فایل های انتخابی فایل دیگری ارسال کند
                                    برای مثال برای جنشواره نقاشی بهتر است فقط فایل های تصویری را انتخاب کنید
                                </div>
                            </div>
                            <v-select dir="rtl" placeholder="نوع فایل های قابل ارسال را انتخاب کنید" label="name" :reduce="item => item.val"  multiple v-model="form.formats" :options="format_options" ></v-select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'formats')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="form-group">
                            <label>محدودیت ارسال آثار برای هر کاربر</label>
                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#collapse_sends">
                                <i class="fas fa-question align-middle"></i>
                            </button>
                            <div class="collapse" id="collapse_sends">
                                <div class="card card-body bg-success text-light text-bold-2">
                                    تعداد دفعاتی که یک کاربر میتواند در جشنواره شرکت کند و آثار ارسال کند
                                </div>
                            </div>
                            <input v-model="form.sends" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'sends').length}">
                            <div class="text-secondary">
                                برای نامحدود کردن تعداد ارسال، این قسمت را خالی بگذارید
                            </div>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'sends')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="card shadow">
                            <div class="card-header pl-3 pr-3 bg-purple-deep">
                                <h6 class="font-15 text-light"><i class="fas fa-list font-24"></i> فرم اختصاصی جشنواره</h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-primary">
                                    <p>
                                        در این قسمت شما میتوانید با ثبت فرم دلخواه خود، علاوه بر اطلاعات اصلی (نام کامل ، شماره تماس ، جنسیت و ...)، اطلاعات مورد نظر خود را از شرکت کننده گان دریافت کنید.
                                    </p>
                                </div>

                                <div class="mt-3 text-center">
                                    <button @click="AddForms" class="btn btn-info"><i class="fas fa-plus-circle"></i> افزودن فرم جدید</button>
                                    <div v-if="add_forms === true" class="mt-3 app-fade-in row justify-content-center">
                                        <div class="col-md-5 text-right">
                                            <div class="form-group">
                                                <label class="form-label">پرسش</label>
                                                <input v-model="form_forms.form" class="form-control" type="text">
                                            </div>
                                            <div class="form-group mt-4">
                                                <label class="form-label">پاسخ الزامی است ؟</label>
                                                <select v-model="form_forms.required" class="form-control">
                                                    <option value="0">خیر</option>
                                                    <option value="1">بله</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-4">
                                                <button @click="AddFormsSubmit" class="btn btn-success">افزودن فرم</button>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div v-for="(form,index) in form.forms" :key="index" class="col-md-3">
                                                <div class="card p-3 shadow text-right text-dark">
                                                    <div>
                                                        <span class="text-primary text-bold-3">پرسش : </span>
                                                        <span class="text-bold-2">{{form.form}}</span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <span class="text-primary text-bold-3">اجباری است ؟ </span>
                                                        <span v-if="form.required === '1'">
                                                                <i class="fas fa-check text-success font-20"></i> بله
                                                            </span>
                                                        <span v-else>
                                                                <i class="fas fa-times text-danger font-20"></i> خیر
                                                            </span>
                                                        <span  class="float-left"><i @click="RemoveForm(form.form)" class="fas fa-trash font-18 text-danger"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card shadow">
                            <div class="card-header pl-3 pr-3 bg-teal2">
                                <h6 class="font-15 text-light"><i class="fas fa-handshake-alt font-22 "></i> حامیان این جشنواره</h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success">
                                    <p>شما میتوانید در این قسمت حامیان (اسپانسرها) جشنواره خود را اضافه کنید، اطلاعات حامیان در صفحه جشنواره نمایش داده خواهد شد</p>
                                </div>
                                <div class="mt-3 text-center">
                                    <button @click="AddSponsor" class="btn bg-teal2 text-light"><i class="fas fa-plus-circle"></i> افزودن حامی جدید</button>
                                    <div v-if="add_sponsor === true" class="mt-3 app-fade-in row justify-content-center">
                                        <div class="col-md-5 text-right">
                                            <div class="form-group">
                                                <label class="form-label">نام حامی</label>
                                                <input v-model="form_sponsor.name" class="form-control" type="text">
                                            </div>
                                            <div class="form-group mt-4">
                                                <label class="form-label">لینک حامی</label>
                                                <input v-model="form_sponsor.link" class="form-control" type="text">
                                            </div>
                                            <div class="form-group mt-4">
                                                <label class="form-label">تصویر لوگو</label>
                                                <input @change="SponsorPhotoSave" class="form-control" type="file">
                                            </div>
                                            <div class="form-group mt-4">
                                                <button @click="AddSponsorSubmit" class="btn btn-secondary">افزودن حامی</button>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div v-for="(sponsor,index) in form.sponsors" :key="index" class="col-md-3">
                                                <div class="card p-3 shadow text-right text-dark">
                                                    <div>
                                                        <img v-if="sponsor.logo === null" src="/template/images/svg/sponsor-default.png" width="50" alt="">
                                                        <img v-else :src="sponsor.logo" width="50" alt="">
                                                        <span class="text-bold-3">{{sponsor.name}}</span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <i class="fas fa-link font-24 text-info"></i> :
                                                        <span class="text-bold-3">{{sponsor.link}}</span><span  class="float-left"><i @click="RemoveSponsor(sponsor.name)" class="fas fa-trash font-18 text-danger"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="form-group">
                            <label>توضیحات کامل در مورد جشنواره </label>
                            <textarea v-model="form.description" class="form-control" rows="10"></textarea>

                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="form-group">
                            <label>قوانین و مقررات جشنواره </label>
                            <textarea v-model="form.terms" class="form-control" rows="10"></textarea>

                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <button @click="FormSubmit" type="button" class="btn btn-primary waves-effect  waves-light font-14"><i v-if="formloading == false" class="fas fa-pen "></i> <i v-else class="fas fa-spinner fa-spin"></i> ویرایش اطلاعات جشنواره</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Panel_Title from "../Panel_Title";
import SweetAlert from "../../../helpers/SweetAlert";

export default {
    name: "Panel_Festival_Edit",
    components : {
        'panel_title': Panel_Title
    },
    created() {
        this.GetAllCategories();
         this.GetFestival();
    },
    data(){
        return {
            festival:null,
            title:null,
            categories : [],
            format_options: [
                { name: 'عکس', val: 'image' },
                { name: 'ویدئو', val: 'video' },
                { name: 'متنی', val: 'text' },
                { name: 'صوتی', val: 'voice' },
                { name: 'فشرده', val: 'zip' },
            ],
            form : {
                festival_category_id : null,
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
                sponsors:[],
                forms:[],
            },
            errors : {},
            formloading : false,
            form_sponsor:{
                name:null,
                link:null,
                logo:null,
            },
            form_forms:{
                form:null,
                required:0,
            },
            add_sponsor:false,
            add_forms:false,
        }
    },
    methods : {
        GetFestival(){
            axios.get('/api/panel/festivals/show/'+this.$route.params.slug).then(response=>{
                this.festival = response.data;
                this.title = "ویرایش اطلاعات جشنواره : " + this.festival.title

                //fill models
                this.form.title = this.festival.title;
                this.form.festival_category_id = this.festival.festival_category_id;
                this.form.subtitle = this.festival.subtitle;
                this.form.slug = this.festival.slug;
                this.form.description = this.festival.description;
                this.form.terms = this.festival.terms;
                this.form.logo = this.festival.banner;
                this.form.terms = this.festival.terms;
                this.form.sends = this.festival.sends;
                this.form.formats = this.festival.formatshow;
                this.form.forms = JSON.parse(this.festival.forms);
                this.festival.sponsors.forEach(sponser => this.form.sponsors.push(sponser));

            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/panel/festivals/edit/'+this.$route.params.slug,this.form).then(response=>{
                SweetAlert.SweetToastMessage('اطلاعات جشنواره مورد نظر باموفقیت بروز شد',)
                this.$router.push({name : 'panel_festivals_manage',params : {slug : this.festival.slug}})
            }).catch(error => {
                if (error.response.status === 421){
                    this.errors = error.response.data
                    SweetAlert.SweetToastMessage('خطایی وجود دارد، لطفا اطلاعات را بررسی کنید','error');

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
        SponsorPhotoSave(e){
            let file = e.target.files[0];

            if ( file.type !== 'image/jpeg' && file.type !== 'image/png'){
                SweetAlert.SweetToastMessage('فایل انتخابی باید یک تصویر باشد','error')
            }else if (file.size > 1048576){
                SweetAlert.SweetToastMessage('حجم فایل انتخابی باید کمتر از ۱ مگابایت باشد','error')
            }else {
                let reader = new FileReader();
                reader.onload  = e =>{
                    this.form_sponsor.logo = e.target.result
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
        },
        AddSponsor(){
            this.add_sponsor = this.add_sponsor !== true;
        },
        AddForms(){
            this.add_forms = this.add_forms !== true;
        },
        AddSponsorSubmit(){
            if (this.form_sponsor.name === null || this.form_sponsor.name === ''){
                SweetAlert.SweetToastMessage('وارد کردن نام حامی الزامی است','error');
            }else {
                this.form.sponsors.push({name:this.form_sponsor.name,link:this.form_sponsor.link,logo:this.form_sponsor.logo});
                this.form_sponsor.name=null;
                this.form_sponsor.logo=null;
                this.form_sponsor.link=null;
                this.add_sponsor=false;
            }


        },
        AddFormsSubmit(){
            if (this.form_forms.form === null || this.form_forms.form === ''){
                SweetAlert.SweetToastMessage('وارد کردن پرسش الزامی است','error');
            }else {
                this.form.forms.push({form:this.form_forms.form,required:this.form_forms.required});
                this.form_forms.form=null;
                this.add_forms=false;
            }


        },
        RemoveSponsor(name){
            this.form.sponsors = this.form.sponsors.filter(sponsor=>{
                return sponsor.name !== name;
            })
        },
        RemoveForm(form){
            this.form.forms = this.form.forms.filter(item=>{
                return item.form !== form;
            })
        },
    }
}
</script>

<style scoped>

</style>
