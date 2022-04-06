<template>

    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    مدیریت جشنواره : <span v-if=" festival !== null" class="text-bold-3 font-15 text-danger">{{festival.title}}</span>
                </div>
                <router-link :to="{name : 'panel_festivals'}" class="float-end btn btn-secondary">
                    بازگشت <i class="fas fa-backward"></i>
                </router-link>
            </div>
        </div>
        <div class="mt-4 row">
            <div v-if="festival !== null && festival.force_close === 1" class="col-12 mt-2 mb-2 app-fade-in">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle text-danger font-24 fa-beat ml-2" style="--fa-beat-scale: 1.8;"></i>
                    <span class="font-16 ">کاربر گرامی،این جشنواره بنابه دلایلی از سمت مدیریت فستیکا مسدود شده است . لطفا برای کسب اطلاعات بیشتر به مدیریت پیام دهید</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card top-bid app-fade-in">
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
                                    <span class="font-17 text-danger text-bold-2" v-if="festival !== null">{{festival.title}}</span>
                                </div>
                                <div class="mt-3">
                                    <span class="font-14">دسته بندی : </span><span class="font-15 text-bold-2 text-danger" v-if="festival !== null" >{{festival.category.name}}</span>
                                </div>
                                <div class="mt-3">
                                    <span class="font-14">تاریخ شروع : </span><span class="font-15 text-bold-2 text-danger" v-if="festival !== null" >{{festival.start_at | filter_date}}</span>
                                </div>
                                <div class="mt-3">
                                    <span class="font-14">تاریخ اتمام : </span><span class="font-15 text-bold-2 text-danger" v-if="festival !== null" >{{festival.expire_at | filter_date}} - ({{ festival.period}}) روزه</span>
                                </div>
                                <div class="mt-3">
                                    <span class="font-14">وضعیت : </span>
                                    <span v-if="festival !== null && festival.force_close === 1 " class="badge bg-red3 font-13 p-2"><i class="fas fa-exclamation-triangle"></i> مسدود توسط مدیریت</span>
                                    <span v-else-if="festival !== null && festival.accepted === 0 " class="badge bg-yellow3 font-13 p-2"><i class="fas fa-spinner fa-spin"></i> در انتظار تایید</span>
                                    <span v-else-if="festival !== null && festival.is_active === 1 " class="badge bg-green3 font-13 p-2"><i class="fas fa-check"></i> درحال برگزاری</span>
                                    <span v-else-if="festival !== null && festival.is_active === 0 " class="badge bg-red3 font-13 p-2"><i class="fas fa-times"></i> غیرفعال شده</span>
                                </div>
                            </div>
                            <div class="col-12 mt-5 row">
                                <div class="col p-1">
                                    <router-link to="" v-if="festival !== null "   class="btn btn-primary btn-sm manage-btn font-13 w-100" >
                                        <i class="fas fa-edit"></i> ویرایش جشنواره
                                    </router-link>
                                </div>
                                <div class="col p-1">
                                    <router-link :to="{name : 'panel_festivals_files',params:{slug : festival.slug}}" v-if="festival !== null "   class="btn bg-teal3 btn-sm manage-btn font-13 w-100" >
                                        <i class="fas fa-users"></i> آثار ارسالی
                                    </router-link>
                                </div>
                                <div class="col p-1">
                                    <button v-if="festival !== null && festival.is_active === 1"  @click="ItemInactive(festival.id)"  class="btn btn-danger btn-sm manage-btn font-13 w-100" :disabled="festival.force_close === 1">
                                        <i class="fas fa-times"></i> غیرفعال سازی
                                    </button>
                                    <button v-else-if="festival !== null && festival.is_active === 0" @click="ItemActive(festival.id)" class="btn btn-success btn-sm manage-btn font-13 w-100" :disabled="festival.force_close === 1">
                                        <i class="fas fa-check"></i> فعال سازی
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card top-bid app-fade-in">
                    <div class="card-body">
                        <div class="font-18">منابع جشنواره</div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="stat-widget shadow">
                                        <div class="d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-blue3">
                                                <span><i class="fas fa-server font-22"></i></span>
                                            </div>
                                            <div class="widget-content">
                                                <h6 class="mr-2">فضای ذخیره سازی</h6>
                                            </div>
                                        </div>
                                        <div class="mt-3 row text-center">
                                            <div class="col"><span class="text-bold-3">کل : </span><span v-if="festival !== null" dir="ltr" class="text-bold-3 text-danger font-16">{{festival.disk}} GB</span></div>
                                            <div class="col"><span class="text-bold-3">مصرفی : </span><span v-if="festival !== null" dir="ltr" class="text-bold-3 text-danger font-16">{{ festival.disk_usage | filter_size('g') }} GB</span></div>
                                            <div class="col"><span class="text-bold-3">مانده : </span><span v-if="festival !== null" dir="ltr" class="text-bold-3 text-danger font-16">{{ (festival.disk*1024*1024*1024) - festival.disk_usage | filter_size('g')}} GB</span></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="stat-widget shadow">
                                        <div class="d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-green3">
                                                <span><i class="fas fa-users font-22"></i></span>
                                            </div>
                                            <div class="widget-content">
                                                <h6 class="mr-2">تعداد آثار دریافتی</h6>
                                            </div>
                                        </div>
                                        <div class="mt-3 row text-center">
                                            <div class="col"><span class="text-bold-3">کل : </span><span v-if="festival !== null && festival.quantity !== null" class="text-bold-3 text-danger font-16">{{festival.quantity}} اثر</span><span v-else-if="festival !== null && festival.quantity === null" class="text-bold-3 text-danger font-16"> نامحدود </span></div>
                                            <div class="col"><span class="text-bold-3">مصرفی : </span><span v-if="festival !== null" class="text-bold-3 text-danger font-16">{{ festival.files_count }} اثر</span></div>
                                            <div class="col"><span class="text-bold-3">مانده : </span><span v-if="festival !== null && festival.quantity !== null" class="text-bold-3 text-danger font-16">{{festival.quantity - festival.files_count }} اثر</span><span v-else-if="festival !== null && festival.quantity === null" class="text-bold-3 text-danger font-16"> نامحدود </span></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="stat-widget shadow">
                                        <div class="d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-pink3">
                                                <span><i class="fas fa-calendar font-22"></i></span>
                                            </div>
                                            <div class="widget-content">
                                                <h6 class="mr-2">دوره برگذاری</h6>
                                            </div>
                                        </div>
                                        <div class="mt-3 row text-center">
                                            <div class="col"><span class="text-bold-3">کل : </span><span v-if="festival !== null"  class="text-bold-3 text-danger font-16">{{festival.period}} روز</span></div>
                                            <div class="col"><span class="text-bold-3">مصرفی : </span><span v-if="festival !== null"  class="text-bold-3 text-danger font-16">{{ festival.disk_usage | filter_size('g') }} GB</span></div>
                                            <div class="col"><span class="text-bold-3">مانده : </span><span v-if="festival !== null"  class="text-bold-3 text-danger font-16">{{ (festival.disk*1024*1024*1024) - festival.disk_usage | filter_size('g')}} GB</span></div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="mt-1">
                                <button class="btn bg-blue3 w-100">ارتقاع منابع جشنواره</button>
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

export default {
    name: "Panel_Festivals_Manage",
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
.ml-2{
    margin-left: 10px!important;
}
.ml-3{
    margin-left:15px !important; ;
}
.mr-2{
    margin-right: 10px!important;
}
.mr-3{
    margin-right:15px !important; ;
}
</style>
