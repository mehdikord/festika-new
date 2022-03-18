<template>

    <div>
        <manage_title title="جشنواره ها"></manage_title>
        <div class="card">
            <div class="card-header">
                <div class="font-16 text-bold-2 text-danger ">
                   لیست جشنواره های درحال برگذاری
                    <router-link :to="{name : 'manage_festival_create'}">
                        <button type="button" class="btn btn-outline-dark waves-effect waves-light float-end">
                            <i class="fas fa-plus font-size-16 align-middle me-2"></i>برگذاری جشنواره جدید
                        </button>
                    </router-link>
                </div>
                <div class="mt-5">
                    <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show app-fade-in" role="alert">
                        <i class="fas fa-info-circle label-icon font-20"></i><strong>نکته : </strong>
                        برای مدیریت کامل جشنواره ( ویرایش اطلاعات و منابع - مشاهده امور مالی - فعال و غیرفعال کردن و ... ) با استفاده از دکمه مدیریت، وارد صفحه مدیریت جشنواره شوید.
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-if="item_loading === false" class="pb-4">
                    <h6 class="font-14 text-secondary">جستجو و فیلتر</h6>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-search font-18 text-primary"></i></div>
                                <input :class="{'is-invalid' : search && DoSearchItems.length < 1}" v-model="search" type="text" class="form-control"  placeholder="جستجو ... ">
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="item_loading === false" class="table-responsive">

                    <table v-if="DoSearchItems.length > 0" class="table table-bordered table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>عنوان</th>
                            <th>کاربر</th>
                            <th>دسته بندی</th>
                            <th>کد</th>
                            <th>تاریخ برگذاری</th>
                            <th>تاریخ پایان</th>
                            <th>وضعیت</th>
                            <th>تعداد آثار</th>
                            <th>تاریخ ثبت</th>
                            <th>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in DoSearchItems" :key="index" class="app-fade-in">

                            <td>
                                <img v-if="item.logo" :src="item.logo" width="60" height="60" class="me-0" alt="">
                                <img v-else src="/management/images/no-photo.png" width="50" height="50" class="me-0" alt="">
                                {{ item.title }}
                            </td>
                            <td>
                                <span class="text-primary text-bold-3 font-15" v-if="item.user !== null">{{ item.user.name }}</span>
                            </td>
                            <td>
                                <span class="text-info text-bold-3" v-if="item.category !== null">{{ item.category.name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-orange2 font-15">{{item.code}}</span>
                            </td>
                            <td>
                                <span class="badge bg-green3 font-15">{{ item.start_at | filter_date('jYYYY/jM/jD') }}</span>
                            </td>
                            <td>
                                <span class="badge bg-red3 font-15">{{ item.expire_at | filter_date('jYYYY/jM/jD') }} - 30 روز مانده</span>
                            </td>
                            <td>
                                <button @click="ChangeActivation(index,item.id)" v-if="item.is_active === 1 " type="button" class="btn btn-success waves-effect btn-label waves-light btn-sm"><i class="fas fa-check label-icon"></i> فعال</button>
                                <button @click="ChangeActivation(index,item.id)" v-else type="button" class="btn btn-danger waves-effect btn-label waves-light"><i class="fas fa-times label-icon btn-sm"></i> غیرفعال</button>
                            </td>
                            <td>
                                <span class="badge bg-purple-deep font-16">150</span>
                            </td>
                            <td>
                                <span class="badge bg-blue2 font-15">{{ item.created_at | filter_date('jYYYY/jM/jD') }}</span>
                            </td>
                            <td class="text-center">
                                <router-link :to="{name : 'manage_users_managers_edit' , params : {id : item.id}}">
                                    <button type="button" class="btn btn-primary waves-effect btn-label waves-light"><i class="fas fa-cog label-icon"></i> مدیریت</button>
                                </router-link>
                                <router-link :to="{name : 'manage_users_managers_edit' , params : {id : item.id}}">
                                    <button type="button" class="btn btn-primary bg-teal3 waves-effect btn-label waves-light"><i class="fas fa-users label-icon"></i> آثار</button>
                                </router-link>
                                <router-link :to="{name : 'manage_users_managers_edit' , params : {id : item.id}}">
                                    <button type="button" class="btn btn-primary bg-orange3 waves-effect btn-label waves-light"><i class="fas fa-chart-line label-icon"></i> گزارش گیری</button>
                                </router-link>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                    <manage_nodata v-else></manage_nodata>
                </div>
                <manage_loading v-else></manage_loading>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Title from "../Manage_Title";
import Manage_Nodata from "../Manage_Nodata";
import Manage_Loading from "../Manage_Loading";
import SweetAlert from "../../../helpers/SweetAlert";

export default {
    name: "Manage_Festivals",
    created() {
        this.GetAllItems();
    },
    components: {
        'manage_title' : Manage_Title,
        'manage_nodata' : Manage_Nodata,
        'manage_loading' : Manage_Loading
    },
    data(){
        return {
            items : {},
            item_loading : true,
            search:'',
        }
    },
    computed : {
        DoSearchItems(){
            return this.items.filter(item => {

                return item.title !== null && item.title.match(this.search);

            });
        }
    },
    methods : {
        GetAllItems(){
            axios.get('/api/manage/festivals').then(response => {
                if (response.data){
                    this.items = response.data;
                    this.item_loading = false;
                }
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage()
            })
        },
        ChangeActivation(index,id){
            axios.get('/api/manage/users/managers/activation/'+id).then(response=>{
                this.items[index].is_active = response.data
                SweetAlert.SweetToastMessage('عملیات باموفقیت انجام شد');
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage()
            })
        }
    },


}
</script>

<style scoped>

</style>
