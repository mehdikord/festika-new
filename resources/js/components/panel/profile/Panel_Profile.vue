<template>
    <div>
        <manage_title title="پروفایل"></manage_title>
        <div class="card">
            <div class="card-header bg-success">
                <div class="font-16 text-bold-2 text-light">
                   اطلاعات حساب کاربری شما
                </div>
            </div>
            <div class="card-body">
                <div class="card border-0">
                    <div class="card-body border-0">
                        <div class="row">
                            <div class="col-md-6">
                                <img v-if="user.profile === null" class="app-fade-in img-fluid avatar-xl" src="/management/images/user.png" alt="">
                                <img v-else class="app-fade-in img-fluid avatar-xl" :src="user.profile" alt="">
                                <span class="me-2 badge bg-orange p-2 font-15 text-bold-3">{{ user.name}}</span><span class="me-2 badge bg-cyan p-2 font-15 text-bold-3">{{ user.phone}}</span>

                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start justify-content-end gap-2">
                                    <div>
                                        <button @click="EnableEdit" type="button" class="btn btn-primary "><i class="fas fa-pen me-1"></i> ویرایش اطلاعات</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div v-if="edit === true" class="app-fade-in">
                                    <div class="row justify-content-center">
                                        <div class="col-md-9 row">

                                            <div class="col-md-6 mt-5">
                                                <label class="form-label">نام کامل</label>
                                                <input type="text" class="form-control" v-model="form.name" :class="{'is-invalid' : this.ValidationErrors(errors,'name').length}">
                                                <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'name')" :key="index">
                                                    {{ error }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label class="form-label">آدرس ایمیل</label>
                                                <input type="text" class="form-control" v-model="form.email" :class="{'is-invalid' : this.ValidationErrors(errors,'email').length}">
                                                <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'email')" :key="index">
                                                    {{ error }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label class="form-label">استان</label>
                                                <select @change="SetCities" v-model="form.province_id" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'province_id').length}">
                                                    <option v-for="(province,index) in provinces" :key="index" :value="province.id">
                                                        {{province.name}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label class="form-label">شهر</label>
                                                <select v-model="form.city_id" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'city_id').length}">
                                                    <option v-for="(city,index) in cities" :key="index" :value="city.id" >
                                                        {{city.name}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label class="form-label">جنسیت</label>
                                                <select v-model="form.gender" class="form-control">
                                                    <option value="1">آقا</option>
                                                    <option value="0">خانم</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label class="form-label ">تصویر پروفایل</label>
                                                <input @change="PhotoSave" type="file" class="form-control" >
                                                <div v-if="form.profile" class="mt-3">
                                                    <img :src="form.profile" width="70" height="70" alt="">
                                                    <i class="fas fa-trash text-danger font-22"  @click="RemoveSelectPhoto"></i>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-5">
                                                <label class="form-label">بیوگرافی</label>
                                                <textarea class="form-control" rows="8" v-model="form.bio"></textarea>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button @click="FormSubmit" class="btn btn-success font-14 text-bold-3"><i class="fas fa-check"></i> ذخیره اطلاعات کاربری</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else class="row app-fade-in">
                                    <div class="col-md-3 mt-4">
                                        <span class="text-muted font-13 text-bold-3"><i class="mdi mdi-email font-30 text-danger"></i> آدرس ایمیل : </span><span class="text-success font-14 text-bold-3">{{user.email}}</span>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <span class="text-muted font-13 text-bold-3"><i class="mdi mdi-city font-30 text-danger"></i> استان : </span><span v-if="user.province_id !== null" class="text-success font-14 text-bold-3">{{user.province.name}}</span>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <span class="text-muted font-13 text-bold-3"><i class="mdi mdi-city font-30 text-danger"></i> شهر : </span><span v-if="user.city_id !== null" class="text-success font-14 text-bold-3">{{user.city.name}}</span>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <span class="text-muted font-13 text-bold-3"><i class="mdi mdi-gender-transgender font-30 text-danger"></i> جنسیت : </span><span class="text-success font-14 text-bold-3">
                                        <span v-if="user.gender === 1">آقا</span>
                                        <span v-else>خانم</span>
                                    </span>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <span class="text-muted font-13 text-bold-3"><i class="mdi mdi-bio font-30 text-danger"></i> بیوگرافی : </span><span class="text-dark font-14 text-bold-3">{{user.bio}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import Manage_Title from "../../manage/Manage_Title";

export default {
    name: "Panel_Profile",
    components :{
        'manage_title' : Manage_Title,
    },
    created() {
        this.GetUser();
        this.GetAllProvinces();
    },
    data (){
        return {
            errors:{},
            user : {
                name:null,
                phone:null,
                email:null,
                province_id:null,
                city_id:null,
                gender:null,
                is_active:null,
                profile:null,
                created_at:null,
                bio:null,
            },
            edit:false,
            form : {
                name:null,
                email:null,
                province_id:null,
                city_id:null,
                gender:null,
                profile:null,
                bio:null,
            },
            provinces : {},
            cities : {},

        }
    },
    methods:{
        GetUser(){
            axios.get('/api/panel/me').then(response=>{
                this.user = response.data;
                this.form.name = this.user.name;
                this.form.email = this.user.email;
                this.form.province_id = this.user.province_id;
                this.form.city_id = this.user.city_id;
                this.form.gender = this.user.gender;
                this.form.profile = this.user.profile;
                this.form.bio = this.user.bio;
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            })
        },
        EnableEdit(){
            this.edit = this.edit === false;
        },
        GetAllProvinces(){
            axios.get('/api/helpers/get/provinces').then(response=>{
                this.provinces = response.data;
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        SetCities(){
            let get_province = this.provinces.filter(item =>{
                return item.id === this.form.province_id
            })
            this.cities = get_province[0].cities
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
                    this.form.profile = e.target.result
                };
                reader.readAsDataURL(file)
            }
        },
        RemoveSelectPhoto(){
            this.form.profile = null;
        },
        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/panel/me/update',this.form).then(response=>{
                this.GetUser();
                this.edit=false;
                SweetAlert.SweetToastMessage(response.data)
            }).catch(error => {
                if (error.response.status === 421){
                    SweetAlert.SweetToastMessage('مشکلی وجود دارد !','error')

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
