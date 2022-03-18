<template>

    <div>
        <manage_title title="مدیریت جشنواره ها"></manage_title>
        <div class="card">
            <div class="card-header">
                <span class="font-16 text-bold-2 text-danger">
                    لیست دسته بندی های جشنواره
                </span>
                <button data-bs-toggle="modal" data-bs-target="#add_item" type="button" class="btn btn-outline-dark waves-effect waves-light float-end">
                    <i class="fas fa-plus font-size-16 align-middle me-2"></i> ایجاد آیتم جدید
                </button>

                <div :id="'add_item'" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-16" id="myModalLabel">افرودن دسته بندی جدید</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mt-4">
                                    <label> نام دسته بندی</label>
                                    <input v-model="form.name" class="form-control" type="text" :class="{'is-invalid' : this.ValidationErrors(errors,'name').length}">
                                    <div class="text-danger mt-2" v-for="(error,index) in this.ValidationErrors(errors,'name')" :key="index">
                                        {{ error }}
                                    </div>
                                    <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0 mt-3" role="alert">
                                        <i class="fas fa-info-circle label-icon"></i><strong>نکته :</strong>
                                        نام دسته بندی را بدون فاصله بنویسید، میتوانید از ( - ) بجای فاصله استفاده کنید
                                    </div>

                                </div>
                                <div class="form-group mt-4">
                                    <label> توضیحات</label>
                                    <textarea v-model="form.description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">بستن</button>
                                <button @click="FormSubmit" type="button" class="btn btn-primary waves-effect waves-light"><i v-if="formloading == false" class="fas fa-check "></i> <i v-else class="fas fa-spinner fa-spin"></i> ایجاد دسته بندی</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
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
                            <th>توضیحات</th>
                            <th>تعداد جشنواره ها</th>
                            <th>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in DoSearchItems" :key="index" >

                            <td>{{ item.name }}</td>
                            <td>{{ item.description }}</td>
                            <td>
                                <span class="badge p-2 font-16 bg-primary">0</span>
                            </td>

                            <td class="text-center">
                                <router-link :to="{name : 'manage_festival_categories_edit' , params : {id : item.id}}">
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
import Manage_Loading from "../Manage_Loading";
import SweetAlert from "../../../helpers/SweetAlert";

export default {
    name: "Manage_Festivals_Categories",
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
            errors :{},
            formloading : false,
            form : {
                name: null,
                description: null,
            }

        }
    },
    computed : {
        DoSearchItems(){
            return this.items.filter(item => {
                return item.name.match(this.search);
            });
        }
    },
    methods : {
        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/manage/festivals/categories/store',this.form).then(response=>{
                this.items.push(response.data)
                SweetAlert.SweetToastMessage("دسته بندی جدید باموفقیت ایجاد شد");
                this.form.name = null;
                this.form.description = null;
                $('#add_item').modal('hide');
            }).catch(error => {
                if (error.response.status === 421){
                    this.errors = error.response.data
                }else {
                    SweetAlert.SweetServerErrorMessage()
                }
            })
            this.formloading = false;

        },

        GetAllItems(){
            axios.get('/api/manage/festivals/categories').then(response => {
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
                    axios.get('/api/manage/festivals/categories/delete/'+id).then(response =>{
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
    },
}
</script>

<style scoped>

</style>
