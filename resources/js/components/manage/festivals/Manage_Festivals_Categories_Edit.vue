<template>

    <div>
        <manage_title title="مدیریت جشنواره ها"></manage_title>
        <div class="card">
            <div class="card-header">
                <div class="font-16 text-bold-2 text-danger">
                    ویرایش دسته بندی : <span class="font-16 text-bold-3 text-dark">{{form.name}}</span>
                    <router-link :to="{name : 'manage_festival_categories'}">
                        <button type="button" class="btn btn-danger waves-effect waves-light float-end">
                            <i class="fas fa-backward font-size-16 align-middle me-2"></i> بازگشت
                        </button>
                    </router-link>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="form-group ">
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

                    </div>
                    <div class="col-12 mt-4">
                        <div class="form-group ">
                            <label> توضیحات</label>
                            <textarea v-model="form.description" class="form-control" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="col-12 mt-5">
                        <button @click="FormSubmit" type="button" class="btn btn-success waves-effect  waves-light font-15"><i v-if="formloading == false" class="fas fa-check "></i> <i v-else class="fas fa-spinner fa-spin"></i> ویرایش اطلاعات </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Manage_Title from "../Manage_Title";

export default {
    name: "Manage_Festivals_Categories_Edit",
    components : {
        'manage_title' : Manage_Title,
    },
    created() {
        this.GetItem();
    },
    data(){
        return {
            form : {
                name : null,
                description : null,
            },
            errors : {},
            item :null,
            formloading : false,
        }
    },
    methods : {
        GetItem(){
            axios.get('/api/manage/festivals/categories/' + this.$route.params.id).then(response =>{
                this.form = response.data

            }).catch(e => {
                SweetAlert.SweetServerErrorMessage()
            })
        },
        FormSubmit(){
            this.errors = {};
            this.formloading = true;
            axios.post('/api/manage/festivals/categories/edit/'+this.$route.params.id,this.form).then(response=>{
                this.$router.push({name : 'manage_festival_categories'});
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


    }

}
</script>

<style scoped>

</style>
