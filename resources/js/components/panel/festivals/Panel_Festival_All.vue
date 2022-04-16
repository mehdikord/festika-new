<template>

    <div>
        <manage_title title="جشنواره های شما"></manage_title>
        <div class="card">
            <div class="card-header bg-blue2">
                <div class="font-16 text-bold-2 text-light">
                    لیست همه جشنواره های ایجاد شده
                </div>
            </div>
            <div class="card-body">
                <div class="mt-3 mb-5">
                    <div class="alert alert-success alert-top-border alert-dismissible fade show font-14" role="alert">
                        <i class="mdi mdi-information font-24 me-3 align-middle text-success"></i>
                        کاربر گرامی شما میتواند با کلیک برای دکمه <span class="badge p-2 bg-orange font-13"><i class="fas fa-users"></i> کل آثار ارسالی </span> وارد صفحه آثار ارسالی جشنواره، و با کلیک روی دکمه <span class="badge p-2 bg-blue font-13"><i class="fas fa-cog fa-spin"></i>مدیریت جشنواره</span> وارد صفحه مدیریت کامل جشنواره بشوید

                    </div>
                </div>
                <div class="row">
                    <div v-for="(festival,index) in festivals" :key="index" class="col-md-3 mt-2">
                        <include_festival_item :festival="festival" class="app-fade-in"></include_festival_item>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Title from "../../manage/Manage_Title";
import Panel_Festival_include_Item from "./includes/Panel_Festival_include_Item";
import SweetAlert from "../../../helpers/SweetAlert";

export default {
    name: "Panel_Festival_All",
    components : {
        'manage_title' : Manage_Title,
        'include_festival_item' : Panel_Festival_include_Item
    },
    created() {
        this.GetAllItems();
    },

    data(){
        return {
            loading : true,
            festivals: {},

        }
    },

    methods : {

        GetAllItems(){
            axios.get('/api/panel/festivals').then(response=>{
                this.festivals = response.data;
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

</style>
