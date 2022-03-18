<template>

    <div>
        <manage_title title="مدیران"></manage_title>
        <div class="card">
            <div class="card-header">
                <div class="font-16 text-bold-2 text-danger">
                    فرم ایجاد مدیریت جدید
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label >نام کامل مدیر</label>
                            <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'name').length}">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'name')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label >شماره موبایل</label>
                            <input  v-model="form.phone" type="number" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'phone').length}">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'phone')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label >سطح مدیریتی</label>
                            <select  v-model="form.role" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'role').length}">
                                <option value="1">مدیر کل</option>
                                <option value="2">مدیر داخلی</option>
                                <option value="3">پشتیبانی کاربران</option>
                            </select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'role')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label >آدرس ایمیل</label>
                            <input  v-model="form.email" type="text" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'email').length}">
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'email')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label >انتخاب استان</label>
                            <select @change="SetCities" v-model="form.province_id" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'province_id').length}">
                                <option v-for="(province,index) in provinces" :key="index" :value="province.id">
                                    {{province.name}}
                                </option>
                            </select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'province_id')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label > انتخاب شهر</label>
                            <select v-model="form.city_id" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'city_id').length}">
                                <option v-for="(city,index) in cities" :key="index" :value="city.id" >
                                    {{city.name}}
                                </option>
                            </select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'city_id')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label >جنسیت</label>
                            <select v-model="form.gender" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'gender').length}">
                                <option value="1">آقا</option>
                                <option value="0">خانم</option>
                            </select>
                            <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'gender')" :key="index">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>تصویر پروفایل</label>
                            <input @change="PhotoSave" type="file" class="form-control" >
                            <div v-if="form.profile" class="mt-3">
                                <img :src="form.profile" width="70" height="70" alt="">
                                <button @click="RemoveSelectPhoto" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <button @click="FormSubmit" type="button" class="btn btn-success waves-effect  waves-light font-15"><i v-if="formloading == false" class="fas fa-check "></i> <i v-else class="fas fa-spinner fa-spin"></i> ایجاد مدیر</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Manage_Title from "../Manage_Title";

export default {
    name: "Manage_Managers_Create",
    components : {
        'manage_title' : Manage_Title,
    },
    created() {
        this.GetAllProvinces();
    },
    data(){
        return {
            provinces : {},
            cities : {},
            form : {
                name : null,
                phone : null,
                email : null,
                role : 1,
                province_id : null,
                city_id : null,
                gender : 1,
                profile : null,
            },
            errors : {},
            formloading : false,
        }
    },
    methods : {
        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/manage/users/managers/store',this.form).then(response=>{
                this.$router.push({name : 'manage_users_managers'});
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
        }
    }

}
</script>

<style scoped>

</style>
