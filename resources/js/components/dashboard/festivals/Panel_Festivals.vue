<template>
    <div class="app-fade-in">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                   لیست همه جشنواره های ایجاد شده
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-primary fade show app-fade-in mb" role="alert">
                    <i class="fas fa-info-circle label-icon font-20 ml-2"></i><strong>نکته : </strong>
                    برای مدیریت کامل جشنواره ( ویرایش اطلاعات و منابع  - آمار آثار ارسالی - مشاهده امور مالی - فعال و غیرفعال کردن و ... ) با استفاده از دکمه مدیریت، وارد صفحه مدیریت جشنواره شوید.
                </div>
                <item-loading v-if="loading === true"></item-loading>
                <div class="table-responsive pt-2" v-else-if="items.length > 0">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>دسته بندی</th>
                            <th>کد</th>
                            <th> شروع</th>
                            <th>پایان</th>
                            <th>تعداد آثار</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in items" :key="index">
                            <td>
                                <img v-if="item.logo === null" src="/festika.svg" width="50" alt="">
                                <img v-else :src="item.logo" width="50" alt="">
                                {{item.title}}
                            </td>
                            <td>{{item.category.name}}</td>
                            <td><span class="badge bg-cyan3 font-13 p-2">{{item.code}}</span></td>
                            <td><span class="badge bg-green3 font-13 p-2">{{item.start_at | filter_date()}}</span></td>
                            <td><span class="badge bg-red3 font-13 p-2">{{item.expire_at | filter_date()}}</span></td>
                            <td><span class="badge bg-blue3 font-15 p-2">{{ item.files_count }}</span> عدد</td>
                            <td>
                                <span v-if="item.force_close === 1 " class="badge bg-red3 font-13 p-2"><i class="fas fa-exclamation-triangle"></i> مسدود توسط مدیریت</span>
                                <span v-else-if="item.accepted === 0 " class="badge bg-yellow3 font-13 p-2"><i class="fas fa-spinner fa-spin"></i> در انتظار تایید</span>
                                <span v-else-if="item.is_active === 1 " class="badge bg-green3 font-13 p-2"><i class="fas fa-check"></i> درحال برگزاری</span>
                                <span v-else-if="item.is_active === 0 " class="badge bg-red3 font-13 p-2"><i class="fas fa-times"></i> غیرفعال شده</span>
                            </td>
                            <td>
                                <router-link :to="{name : 'panel_festivals_manage',params: {slug : item.slug}}" class="btn btn-primary btn-sm manage-btn font-13">
                                    <i class="fas fa-cog fa-spin"></i> مدیریت
                                </router-link>
                                <router-link :to="{name : 'panel_festivals_files',params:{slug : item.slug}}" class="btn  btn-sm manage-btn font-13 bg-teal3">
                                    <i class="fas fa-users"></i> آثار
                                </router-link>
                                <button  @click="ItemInactive(item.id)" v-if="item.is_active === 1" class="btn btn-danger btn-sm manage-btn font-13" :disabled="item.force_close === 1">
                                    <i class="fas fa-times"></i> غیرفعال سازی
                                </button>
                                <button @click="ItemActive(item.id)" v-else class="btn btn-success btn-sm manage-btn font-13 " :disabled="item.force_close === 1">
                                    <i class="fas fa-check"></i> فعال سازی
                                </button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <nodata v-else></nodata>

            </div>
        </div>

    </div>

</template>

<script>
import Panel_Item_Loading from "../Panel_Item_Loading";
import Panel_Nodata from "../Panel_Nodata";
import SweetAlert from "../../../helpers/SweetAlert";

export default {
    name: "Panel_Festivals",
    components : {
      'item-loading' : Panel_Item_Loading,
      'nodata' : Panel_Nodata,

    },
    created() {
        this.GetAllItems();
    },

    data(){
        return {
            loading : true,
            items: {},

        }
    },

    methods : {

        GetAllItems(){
            axios.get('/api/panel/festivals').then(response=>{
                this.items = response.data;
                this.loading = false;

            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
         ItemInactive(id){
            Swal.fire({
                title: 'آیا مطمئن هستید',
                text: "با غیرفعال سازی جشنواره امکان شرکت در جشنواره و ارسال آثار توسط شرکت کنندگان غیرفعال میشود",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#26a852',
                cancelButtonColor: '#d33',
                cancelButtonText : 'خیر',
                confirmButtonText: 'انجام شود'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/panel/festivals/activation/'+id).then(response =>{
                        SweetAlert.SweetToastMessage(response.data,'success')
                        this.GetAllItems();
                    }).catch(e=>{
                        SweetAlert.SweetServerErrorMessage()
                    })
                }
            })
        },
         ItemActive(id){
            Swal.fire({
                title: 'آیا مطمئن هستید',
                text: "جشنواره مورد نظر فعال شود ؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#26a852',
                cancelButtonColor: '#d33',
                cancelButtonText : 'خیر',
                confirmButtonText: 'فعال شود'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/panel/festivals/activation/'+id).then(response =>{
                        SweetAlert.SweetToastMessage(response.data,'success')
                        this.GetAllItems();
                    }).catch(e=>{
                        SweetAlert.SweetServerErrorMessage()
                    })
                }
            })
        },

    }


}
</script>

<style scoped>

.ml-2{
    margin-left: 5px!important;
}
.mb{
    margin-bottom: 35px!important;
}
.manage-btn{
    padding: 6px 16px !important;
}
</style>
