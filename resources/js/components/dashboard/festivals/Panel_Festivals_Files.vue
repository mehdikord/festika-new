<template>
    <div class="app-fade-in">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    لیست همه آثار ارسال شده در جشنواره : <span v-if=" festival !== null" class="text-bold-3 font-15 text-danger">{{festival.title}}</span>
                </div>
                <router-link :to="{name : 'panel_festivals'}" class="float-end btn btn-secondary">
                     بازگشت <i class="fas fa-backward"></i>
                </router-link>
            </div>
            <div class="card-body">

                <div v-if="loading === false" class="mb-4 mt-1">
                    <h6 class="font-14">کل آثار ارسال شده در این جشنواره : <span class="font-18 text-bold-3 text-danger">{{festival.files.length}}</span> اثر</h6>
                </div>
                <div class="mb-5 mt-1">
                    <h6 class="font-14 ">جستجو آثار در لیست</h6>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-search font-18 text-primary"></i></div>
                                <input v-model="search" type="text" class="form-control search-input"  placeholder="جستجو ... ">
                            </div>
                        </div>
                    </div>
                </div>
                <item-loading v-if="loading === true"></item-loading>

                <div class="table-responsive pt-2" v-else-if="DoSearchItems.length > 0">

                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>کد اثر</th>
                            <th>نوع</th>
                            <th>حجم</th>
                            <th>دریافت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(file,index) in DoSearchItems" :key="index">
                            <td>
                                <img v-if="file.user.profile === null" class="user-profile" src="/dashboard/images/user-default.png" alt="user">
                                {{file.user.name}}
                            </td>
                            <td><span class="badge bg-cyan3 font-13 p-2">{{file.code}}</span></td>
                            <td><span class="badge bg-pink font-13 p-2">{{file.type}}</span></td>
                            <td dir="ltr"><span class="badge bg-orange3 font-13 p-2">{{file.size}} KB</span></td>
                            <td>
                                <button @click="DownloadFile(file)" class="btn btn-success bg-green3 btn-sm manage-btn font-14">
                                    <i class="fas fa-download"></i> دریافت
                                </button>
                            </td>

                            <td class="text-center">
                                <button  class="btn btn-danger bg-red3 btn-sm manage-btn font-13">
                                    <i class="fas fa-trash"></i> حذف
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
    name: "Panel_Festivals_Files",
    components : {
        'item-loading' : Panel_Item_Loading,
        'nodata' : Panel_Nodata,

    },
    created() {
        this.GetFestival();
    },

    data(){
        return {
            loading : true,
            festival: null,
            search : '',
        }
    },

    methods : {

        GetFestival(){
            axios.get('/api/panel/festivals/files/'+this.$route.params.slug).then(response=>{
                this.festival = response.data;
                this.loading = false;

            }).catch(e => {
                SweetAlert.SweetServerErrorMessage();
            })
        },
        DownloadFile(file) {
            axios({
                url: '/api/panel/festivals/downloader/files/single/'+file.id, // File URL Goes Here
                method: 'GET',
                responseType: 'blob',
            }).then((res) => {
                let FILE = window.URL.createObjectURL(new Blob([res.data]));
                let docUrl = document.createElement('a');
                docUrl.href = FILE;
                docUrl.setAttribute('download', file.code);
                document.body.appendChild(docUrl);
                docUrl.click();
            });
        }


    },
    computed :{
        DoSearchItems(){
            return  this.festival.files.filter(file =>{

                return file.user.name !== null && file.user.name.match(this.search)
                    || file.code !== null && file.code.match(this.search);
            })

        }
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
.user-profile{
    width: 40px;
    margin-left: 10px!important;
}
.search-input{
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
}
</style>
