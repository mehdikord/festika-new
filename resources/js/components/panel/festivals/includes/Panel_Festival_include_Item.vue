<template>
    <div class="card card-h-100 shadow">
        <div class="card-body p-2">
            <div class="row" v-if="festival !== null">
                <div class="col-md-6">
                    <img v-if="festival.logo !== null" :src="festival.logo" class="logo" alt="">
                    <img v-else src="/management/images/festival-logo.png" class="logo" alt="">
                    <span class="font-14 text-bold-3">{{festival.title}}</span>
                </div>
                <div class="col-md-6">
                    <div class="mt-2">
                        <router-link :to="{name : 'panel_festivals_files',params : {slug : festival.slug}}" class="badge p-2 bg-orange font-13 w-100"><i class="fas fa-users"></i> کل آثار ارسالی : <span class="font-15 text-bold-3">{{ festival.files_count }}</span></router-link>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <span class="font-13">دسته بندی : <span v-if="festival.category !== null" class="font-13 text-bold-3 text-danger">{{ festival.category.name}}</span></span>
                </div>
                <div class="col-md-6 mt-3">
                    <span class="font-13">تاریخ ثبت : <span v-if="festival.category !== null" class="font-13 text-bold-3 text-dark">{{ festival.created_at | filter_date }}</span></span>
                </div>
                <div class="col-md-6 mt-3">
                    <span class="font-13">تاریخ شروع : <span v-if="festival.category !== null" class="badge p-1 bg-green font-13 text-bold-3 ">{{ festival.start_at | filter_date }}</span></span>
                </div>
                <div class="col-md-6 mt-3">
                    <span class="font-13">تاریخ پایان : <span v-if="festival.category !== null" class="badge p-1 bg-red font-13 text-bold-3">{{ festival.expire_at | filter_date }}</span></span>
                </div>
                <div class="col-12 mt-4">
                    <router-link :to="{name : 'panel_festivals_manage',params: {slug :festival.slug}}" class="btn btn-primary font-13 text-bold-3 w-100 text-light"><i class="fas fa-cog font-18 fa-spin"></i> مدیریت جشنواره</router-link>
                </div>
                <div class="col-md-12 mt-2">
                    <button v-if="festival.force_close === 1 " class="btn bg-red3 font-13 text-bold-3 w-100 text-light"> وضعیت : مسدود توسط مدیریت <i class="fas fa-exclamation-triangle fa-beat"></i></button>
                    <button v-else-if="festival.accepted === 0 " class="btn bg-yellow3 font-13 text-bold-3 w-100 text-dark">وضعیت : در انتظار تایید <i class="fas fa-spinner fa-spin"></i></button>
                    <button v-else-if="festival.is_expired === 1 " class="btn bg-secondary font-13 text-bold-3 w-100 text-light">وضعیت : پایان یافته <i class="fas fa-gift fa-beat"></i></button>
                    <button v-else-if="festival.is_active === 1 " class="btn bg-green3 font-13 text-bold-3 w-100 text-light">وضعیت : درحال برگزاری <i class="fas fa-check fa-beat"></i></button>
                    <button v-else-if="festival.is_active === 0 " class="btn bg-red3 font-13 text-bold-3 w-100 text-light">وضعیت : غیرفعال شده <i class="fas fa-times fa-beat"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Panel_Festival_include_Item",
    props : ['festival'],
}
</script>

<style scoped>

.logo{
    width: 45px!important;
    height: 45px!important;
    border-radius: 10px!important;
}

</style>
