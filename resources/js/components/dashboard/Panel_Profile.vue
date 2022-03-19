<template>
<div>

    <div class="page-title">
        <div class="row align-items-center justify-content-between">
            <div class="col-6">
                <div class="page-title-content">
                    <h5>اطلاعات حساب کاربری</h5>
                </div>
            </div>
            <div class="col-auto">
                <div class="breadcrumbs text-left" dir="ltr">
                    <a> تنظیمات </a>
                    <span><i class="fas fa-arrow-right"></i>
                </span>
                    <a >پروفایل کاربری</a>
                </div>
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

                <button class="btn btn-primary float-left"><i class="fas fa-edit"></i> ویرایش اطلاعات</button>

                <div class="modal fade" :id="'exampleModal'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

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
        </div>
    </div>

</div>
</template>

<script>
export default {
    name: "Panel_Profile",
    created() {
      this.GetUser();
      // console.log(this.user);
    },
    data (){
        return {
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
        }
    },
    methods:{
        GetUser(){
            axios.get('/api/panel/me').then(response=>{
                this.user = response.data;
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            })
        }
    }

}
</script>

<style scoped>

</style>
