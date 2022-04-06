<template>
<div>

    <div class="page-title">
        <div class="">
            <div class="page-title-content">
                <h5>اطلاعات حساب کاربری</h5>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="alert alert-primary app-fade-in">
            <p class="text-center font-15">
                شما میتوانید در این قسمت اطلاعات حساب کاربری خود را ویرایش کنید
            </p>
        </div>

        <div class="card welcome-profile">
            <div class="card-body">
                <img v-if="user.profile === null" class="app-fade-in" src="/dashboard/images/user-default.png" alt="">
                <img v-else class="app-fade-in" :src="user.profile" alt="">

                <button @click="EnableEdit" class="btn btn-primary float-left"><i class="fas fa-edit"></i> ویرایش اطلاعات</button>
                <div v-if="edit===false">
                    <h5 class="mt-3 app-fade-in">
                        {{user.name}}
                    </h5>
                    <ul>
                        <li class="text-right app-fade-in">
                            <span class="badge bg-green font-20"><i class="fas fa-phone"></i> <span class="font-14">شماره موبایل :</span></span>
                            <span class="font-16 ">{{user.phone}}</span>
                        </li>
                        <li class="text-right app-fade-in">
                            <span class="badge bg-red3 font-20" :class="{'bg-green' : user.email !== null}"><i class="fas fa-envelope"></i> <span class="font-14">آدرس ایمیل :</span></span>
                            <span class="font-16 ">{{user.email}}</span>
                        </li>
                        <li class="text-right app-fade-in">
                            <span class="badge bg-red3 font-20" :class="{'bg-green' : user.province_id !== null}"><i class="fas fa-location-arrow"></i> <span class="font-14">استان :</span></span>
                            <span v-if="user.province_id !== null" class="font-16 ">{{user.province.name}}</span>
                        </li>
                        <li class="text-right app-fade-in">
                            <span class="badge bg-red3 font-20" :class="{'bg-green' : user.city_id !== null}"><i class="fas fa-location-arrow"></i> <span class="font-14">شهر :</span></span>
                            <span v-if="user.city_id !== null" class="font-16 ">{{user.city.name}}</span>
                        </li>
                        <li class="text-right app-fade-in">
                            <span class="badge bg-red3 font-20" :class="{'bg-green' : user.gender !== null}"><i class="fas fa-user"></i> <span class="font-14">جنسیت :</span></span>
                            <span v-if="user.gender !== null && user.gender === 1" class="font-16">آقا</span>
                            <span v-else-if="user.gender !== null && user.gender === 0" class="font-16 ">خانم</span>
                        </li>
                        <li class="text-right app-fade-in">
                            <span class="badge bg-red3 font-20" :class="{'bg-green' : user.is_active !== null}"><i class="fas fa-check"></i> <span class="font-14">وضعیت حساب :</span></span>
                            <span v-if="user.is_active !== null && user.is_active === 1" class="font-16"><i class="fas fa-check text-success font-24"></i> فعال</span>
                            <span v-else-if="user.is_active !== null && user.is_active === 0" class="font-16"><i class="fas fa-times text-danger font-24"></i> غیرفعال</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-5 app-fade-in" v-else>
                    <h5>
                        ویرایش اطلاعات حساب کاربری
                    </h5>
                    <div class="mt-4 row container">
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label class="font-15 mb-3">نام کامل</label>
                                <input type="text" v-model="form.name" class="form-control">
                                <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'name')" :key="index">
                                    {{ error }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label class="font-15 mb-3">آدرس ایمیل</label>
                                <input type="text" v-model="form.email" class="form-control ">
                                <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'email')" :key="index">
                                    {{ error }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label class="font-15 mb-3"> استان</label>
                                <select @change="SetCities" v-model="form.province_id" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'province_id').length}">
                                    <option v-for="(province,index) in provinces" :key="index" :value="province.id">
                                        {{province.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label class="font-15 mb-3">شهر</label>
                                <select v-model="form.city_id" class="form-control" :class="{'is-invalid' : this.ValidationErrors(errors,'city_id').length}">
                                    <option v-for="(city,index) in cities" :key="index" :value="city.id" >
                                        {{city.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label class="font-15 mb-3">جنسیت</label>
                                <select v-model="form.gender" class="form-control">
                                    <option value="1">آقا</option>
                                    <option value="0">خانم</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label class="font-15 mb-3">تصویر پروفایل</label>
                                <input @change="PhotoSave" type="file" class="form-control" >
                                <div v-if="form.profile" class="mt-3">
                                    <img :src="form.profile" width="70" height="70" alt="">
                                        <i class="fas fa-trash text-danger font-22"  @click="RemoveSelectPhoto"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="form-group">
                                <button @click="FormSubmit" class="btn btn-success">ویرایش اطلاعات <i class="fas fa-pen"></i></button>
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
export default {
    name: "Panel_Profile",
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
            },
            edit:false,
            form : {
                name:null,
                email:null,
                province_id:null,
                city_id:null,
                gender:null,
                profile:null,
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
