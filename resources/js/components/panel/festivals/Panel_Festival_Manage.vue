<template>
    <div>
        <manage_title title="مدیریت جشنواره"></manage_title>
        <div class="card">
            <div class="card-header bg-teal">
                <div class="font-16 text-bold-3 text-light">
                    مدیریت جشنواره : <span class="text-dark" v-if="festival !== null">{{festival.title}}</span>
                    <router-link :to="{name : 'panel_festivals'}" class="float-end btn btn-danger">
                        بازگشت <i class="fas fa-backward"></i>
                    </router-link>
                </div>

            </div>
            <div class="card-body">
                <div v-if="festival !== null && festival.force_close === 1" class=" mt-2 mb-2 app-fade-in">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle text-danger font-24 fa-beat ml-2" style="--fa-beat-scale: 1.8;"></i>
                        <span class="font-15 ">کاربر گرامی،این جشنواره بنابه دلایلی از سمت مدیریت فستیکا مسدود شده است . لطفا برای کسب اطلاعات بیشتر به مدیریت پیام دهید</span>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="card app-fade-in shadow">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <img class="img-fluid rounded" width="100%" v-if="festival !== null && festival.banner !== null" :src="festival.banner" alt="">
                                        <img class="img-fluid rounded" width="100%" v-else src="/template/images/svg/festika-banner.jpg" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <img class="img-logo" v-if="festival !== null && festival.logo !== null" :src="festival.logo" alt="">
                                            <img class="img-logo" v-else src="/template/images/svg/default-logo.png"  alt="">
                                            <span class="font-17 text-primary text-bold-2" v-if="festival !== null">{{festival.title}}</span>
                                        </div>
                                        <div class="mt-4">
                                            <span class="font-14">دسته بندی : </span><span class="font-14 text-bold-3 text-danger" v-if="festival !== null" >{{festival.category.name}}</span>
                                        </div>
                                        <div class="mt-4">
                                            <span class="font-14">تاریخ شروع : </span><span class="font-15 text-bold-2 badge bg-red" v-if="festival !== null" >{{festival.start_at | filter_date}}</span>
                                        </div>
                                        <div class="mt-4">
                                            <span class="font-14">تاریخ اتمام : </span><span class="font-15 text-bold-2 badge bg-green3" v-if="festival !== null" >{{festival.expire_at | filter_date}} </span>
                                        </div>
                                        <div class="mt-4">
                                            <span class="font-14">دوره برگزاری : </span><span class="font-15 text-bold-3" v-if="festival !== null" >{{festival.period}} روزه </span>
                                        </div>
                                        <div class="mt-4">
                                            <span class="font-14 text-bold-3">توضیح مختصر : </span><span class="font-15 text-bold-2" v-if="festival !== null" >{{festival.subtitle}} </span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="font-14 text-bold-3">وضعیت : </span>
                                            <span v-if="festival !== null && festival.force_close === 1 " class="badge bg-red3 font-13 p-2"><i class="fas fa-exclamation-triangle"></i> مسدود توسط مدیریت</span>
                                            <span v-else-if="festival !== null && festival.accepted === 0 " class="badge bg-yellow3 font-13 p-2"><i class="fas fa-spinner fa-spin"></i> در انتظار تایید</span>
                                            <span v-else-if="festival !== null && festival.is_expired === 1 " class="badge bg-secondary font-13 p-2"><i class="fas fa-gifts"></i> پایان یافته</span>
                                            <span v-else-if="festival !== null && festival.is_active === 1 " class="badge bg-green3 font-13 p-2"><i class="fas fa-check"></i> درحال برگزاری</span>
                                            <span v-else-if="festival !== null && festival.is_active === 0 " class="badge bg-red3 font-13 p-2"><i class="fas fa-times"></i> غیرفعال شده</span>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 row">
                                        <div class="col p-1">
                                            <router-link :to="{name : 'panel_festivals_edit',params : {slug : festival.slug}}" v-if="festival !== null "   class="btn btn-primary font-14 w-100" >
                                                <i class="fas fa-edit"></i> ویرایش جشنواره
                                            </router-link>
                                        </div>
                                        <div class="col p-1">
                                            <router-link :to="{name : 'panel_festivals_files',params:{slug : festival.slug}}" v-if="festival !== null "   class="btn bg-teal3 font-14 text-light w-100" >
                                                <i class="fas fa-users"></i>  مدیریت آثار ارسالی
                                            </router-link>
                                        </div>
                                        <div class="col p-1">
                                            <button v-if="festival !== null && festival.is_active === 1"  @click="SetInactive(festival.id)"  class="btn btn-danger font-14 w-100" :disabled="festival.force_close === 1">
                                                <i class="fas fa-times"></i> غیرفعال سازی
                                            </button>
                                            <button v-else-if="festival !== null && festival.is_active === 0" @click="SetActive(festival.id)" class="btn btn-success font-13 w-100" :disabled="festival.force_close === 1">
                                                <i class="fas fa-check"></i> فعال سازی
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card app-fade-in shadow">
                            <div class="card-body">
                                <div class="font-18">منابع جشنواره</div>
                            </div>
                            <div class="card-body">
                                <div class="mt-1">
                                    <div>
                                        <div>
                                            <span class="badge p-2 bg-success font-15"><i class="fas fa-server"></i> فضای ذخیره سازی</span>
                                        </div>
                                        <div class="mt-3 row">
                                            <div class="col"><span class="text-bold-3">کل : </span><span v-if="festival !== null" dir="ltr" class="text-bold-3 text-danger font-16">{{festival.disk}} GB</span></div>
                                            <div class="col"><span class="text-bold-3">مصرفی : </span><span v-if="festival !== null" dir="ltr" class="text-bold-3 text-danger font-16">{{ festival.disk_usage | filter_size('g') }} GB</span></div>
                                            <div class="col"><span class="text-bold-3">مانده : </span><span v-if="festival !== null" dir="ltr" class="text-bold-3 text-danger font-16">{{ (festival.disk*1024*1024*1024) - festival.disk_usage | filter_size('g')}} GB</span></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div>
                                            <span class="badge p-2 bg-orange font-15"><i class="fas fa-users"></i> تعداد آثار دریافتی</span>
                                        </div>
                                        <div class="mt-3 row">
                                            <div class="col"><span class="text-bold-3">کل : </span><span v-if="festival !== null && festival.quantity !== null" class="text-bold-3 text-danger font-16">{{festival.quantity}} اثر</span><span v-else-if="festival !== null && festival.quantity === null" class="text-bold-3 text-danger font-16"> نامحدود </span></div>
                                            <div class="col"><span class="text-bold-3">مصرفی : </span><span v-if="festival !== null" class="text-bold-3 text-danger font-16">{{ festival.files_count }} اثر</span></div>
                                            <div class="col"><span class="text-bold-3">مانده : </span><span v-if="festival !== null && festival.quantity !== null" class="text-bold-3 text-danger font-16">{{festival.quantity - festival.files_count }} اثر</span><span v-else-if="festival !== null && festival.quantity === null" class="text-bold-3 text-danger font-16"> نامحدود </span></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div>
                                            <span class="badge p-2 bg-purple-deep font-15"><i class="fas fa-calendar"></i> دوره برگذاری</span>
                                        </div>
                                        <div class="mt-3 row">
                                            <div class="col"><span class="text-bold-3">شروع : </span><span v-if="festival !== null"  class="text-bold-3 text-success font-16">{{festival.start_at | filter_date}}</span></div>
                                            <div class="col"><span class="text-bold-3">پایان : </span><span v-if="festival !== null"  class="text-bold-3 text-danger font-16">{{festival.expire_at | filter_date}}</span></div>
                                            <div class="col"><span class="text-bold-3">باقی مانده : </span><span v-if="festival !== null"  class="text-bold-3 text-danger font-16">{{ GetDiffDays(festival.start_at,festival.expire_at) }} روز</span></div>
                                        </div>
                                    </div>
                                    <div class="mt-5 mb-1">
                                        <button class="btn bg-blue3 w-100 text-light font-15 text-bold-3"><i class="fas fa-rocket font-20"></i> ارتقاء منابع جشنواره</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-12">
                        <manage_festivals_report_main v-if="festival !== null" :festival="festival"></manage_festivals_report_main>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Title from "../../manage/Manage_Title";
import SweetAlert from "../../../helpers/SweetAlert";
import moment from "moment-jalaali";
import Panel_Festival_Include_Reports_Main from "./includes/Panel_Festival_Include_Reports_Main";

export default {
    name: "Panel_Festival_Manage",
    components : {
        'manage_title' : Manage_Title,
        'manage_festivals_report_main' : Panel_Festival_Include_Reports_Main,
    },
    created() {
        this.GetFestival();
    },
    data(){
        return {
            festival: null,
        }
    },

    methods : {
        GetFestival(){
            axios.get('/api/panel/festivals/show/'+this.$route.params.slug).then(response=>{
                this.festival = response.data;
                this.loading = false;
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        GetDiffDays(start,end){
            var a = moment(moment(start).format('Y,MM,DD'))
            var b = moment(moment(end).format("Y,MM,DD"))
            return b.diff(a, 'days');
        },
        SetInactive(id){
            Swal.fire({
                title: 'آیا مطمئن هستید',
                text: "آیا مطمئن هستید جشنواره مورد نظر غیرفعال شود ؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#26a852',
                cancelButtonColor: '#d33',
                cancelButtonText : 'خیر',
                confirmButtonText: 'غیرفعال شود!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/panel/festivals/activation/'+id).then(response =>{
                        SweetAlert.SweetToastMessage(response.data)
                        this.festival.is_active = 0;

                    }).catch(e=>{
                        SweetAlert.SweetServerErrorMessage()
                    })
                }
            })
        },
        SetActive(id){
            Swal.fire({
                title: 'آیا مطمئن هستید',
                text: "آیا مطمئن هستید جشنواره مورد نظر فعال شود ؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#26a852',
                cancelButtonColor: '#d33',
                cancelButtonText : 'خیر',
                confirmButtonText: 'فعال شود!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/panel/festivals/activation/'+id).then(response =>{
                        SweetAlert.SweetToastMessage(response.data)
                        this.festival.is_active = 1;

                    }).catch(e=>{
                        SweetAlert.SweetServerErrorMessage()
                    })
                }
            })
        },




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
</style>
