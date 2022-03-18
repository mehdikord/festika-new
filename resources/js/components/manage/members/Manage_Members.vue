<template>
        <div>
            <manage_title title="کاربران"></manage_title>
            <div class="card">
                <div class="card-header">
                     <div class="font-16 text-bold-2 text-danger ">
                         لیست کاربران وبسایت
                         <router-link :to="{name : 'manage_users_members_create'}">
                         <button type="button" class="btn btn-outline-dark waves-effect waves-light float-end">
                             <i class="fas fa-plus font-size-16 align-middle me-2"></i> ایجاد آیتم جدید
                         </button>
                         </router-link>
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
                                    <th>نام کامل</th>
                                    <th>شماره موبایل</th>
                                    <th>ایمیل</th>
                                    <th>استان</th>
                                    <th>شهر</th>
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in DoSearchItems" :key="index" >
                                <td>
                                    <img v-if="item.profile" :src="item.profile" width="60" height="60" class="me-0" alt="">
                                    <img v-else src="/management/images/no-photo.png" width="50" height="50" class="me-0" alt="">
                                    {{ item.name }}
                                </td>
                                <td>{{ item.phone }}</td>
                                <td>{{ item.email }}</td>
                                <td ><span v-if="item.province !== null">{{ item.province.name }}</span></td>
                                <td ><span v-if="item.city !== null">{{ item.city.name }}</span></td>
                                <td>
                                    <button @click="ChangeActivation(index,item.id)" v-if="item.is_active === 1 " type="button" class="btn btn-success waves-effect btn-label waves-light"><i class="fas fa-check label-icon"></i> فعال</button>
                                    <button @click="ChangeActivation(index,item.id)" v-else type="button" class="btn btn-danger waves-effect btn-label waves-light"><i class="fas fa-times label-icon"></i> غیرفعال</button>
                                </td>
                                <td class="text-center">
                                    <router-link :to="{name : 'manage_users_members_edit' , params : {id : item.id}}">
                                    <button type="button" class="btn btn-primary waves-effect btn-label waves-light"><i class="fas fa-edit label-icon"></i> ویرایش</button>
                                    </router-link>
                                    <button @click="DeleteItem(item.id)" type="button" class="btn btn-danger waves-effect btn-label waves-light"><i class="fas fa-trash label-icon"></i> حذف</button>
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
import SweetAlert from "../../../helpers/SweetAlert";
import Manage_Loading from "../Manage_Loading";

export default {
    name: "Manage_Members",
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
                return item.name !== null && item.name.match(this.search)
                    || item.phone !== null && item.phone.match(this.search)
                    || item.email !== null && item.email.match(this.search) ;
            });
        }
    },
    methods : {
        GetAllItems(){
            axios.get('/api/manage/users/members').then(response => {
                if (response.data){
                    this.items = response.data;
                    this.item_loading = false;
                }
            }).catch(e => {
                SweetAlert.SweetServerErrorMessage()
            })
        },
        DeleteItem(id){
            Swal.fire({
                title: 'آیا مطمئن هستید',
                text: "آیا مطمئن هستید این آیتم حذف شود ؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#26a852',
                cancelButtonColor: '#d33',
                 cancelButtonText : 'خیر',
                confirmButtonText: 'حذف شود!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/manage/users/members/delete/'+id).then(response =>{
                        SweetAlert.SweetToastMessage(response.data,'success')
                        this.items = this.items.filter(item => {
                            return item.id !== id
                        })
                    }).catch(e=>{
                        SweetAlert.SweetServerErrorMessage()
                    })
                }
            })
        },
        ChangeActivation(index,id){
            axios.get('/api/manage/users/members/activation/'+id).then(response=>{
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
