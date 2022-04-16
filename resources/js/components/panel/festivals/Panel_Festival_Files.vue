<template>
    <div>
        <manage_title title="آثار ارسالی"></manage_title>
        <div class="card app-fade-in">
            <div class="card-header bg-purple-deep3">
                <div class="font-16 text-bold-2 text-light">
                    همه آثار ارسال شده در جشنواره : <span v-if=" festival !== null" class="text-bold-3 font-15">{{festival.title}}</span>
                </div>
            </div>
            <div class="card-body">
                <div v-if="loading === false" class="pb-4 mt-3">
                    <h6 class="font-14 text-secondary">جستجو و فیلتر آثار</h6>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-search font-18 text-primary"></i></div>
                                <input :class="{'is-invalid' : search && DoSearchItems.length < 1}" v-model="search" type="text" class="form-control"  placeholder="جستجو ... ">
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="loading === false" class="table-responsive">

                    <table v-if="DoSearchItems.length > 0" class="table table-bordered table-hover">
                        <thead class="table-dark">
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
                        <tr v-for="(file,index) in DoSearchItems" :key="index" class="app-fade-in">
                            <td>
                                <img v-if="file.user.profile === null" class="user-profile" src="/dashboard/images/user-default.png" alt="user">
                                <img v-else class="user-profile" :src="file.user.profile" alt="user">
                                {{file.user.name}}
                            </td>
                            <td><span class="badge bg-cyan3 font-13 p-2">{{file.code}}</span></td>
                            <td><span class="badge bg-pink font-13 p-2">{{file.type}}</span></td>
                            <td class="text-right" dir="ltr"><span class="badge bg-orange3 font-13 p-2">{{file.size}} KB</span></td>
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
                    <manage_nodata v-else></manage_nodata>
                </div>
                <manage_loading v-else></manage_loading>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Title from "../../manage/Manage_Title";
import SweetAlert from "../../../helpers/SweetAlert";
import Manage_Nodata from "../../manage/Manage_Nodata";
import Manage_Loading from "../../manage/Manage_Loading";

export default {
    name: "Panel_Festival_Files",
    components : {
        'manage_title' : Manage_Title,
        'manage_nodata' : Manage_Nodata,
        'manage_loading' : Manage_Loading
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
.user-profile{
    width: 40px;
    margin-left: 10px!important;
}
</style>
