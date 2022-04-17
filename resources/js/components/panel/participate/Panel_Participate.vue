<template>
    <div>
        <manage_title title="جشنواره های شرکت شده"></manage_title>
        <div class="card">
            <div class="card-header bg-cyan3">
                <div class="font-16 text-bold-2 text-light">
                    لیست آثار ارسالی شما در جشنواره ها
                </div>
            </div>
            <div class="card-body">
                <div v-if="loading === false" class="pb-4 mt-3">
                    <h6 class="font-14 text-secondary">جستجو و آثار</h6>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-search font-18 text-primary"></i></div>
                                <input :class="{'is-invalid' : search && DoSearchItems.length < 1}" v-model="search" type="text" class="form-control"  placeholder="">
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="loading === false" class="table-responsive">

                    <table v-if="DoSearchItems.length > 0" class="table table-bordered table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>جشنواره</th>
                            <th>کد اثر</th>
                            <th>نوع</th>
                            <th>حجم</th>
                            <th>دریافت</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(file,index) in DoSearchItems" :key="index" class="app-fade-in">
                            <td>
                                <img v-if="file.festival.logo === null" class="user-profile" src="/management/images/festival-logo.png" alt="user">
                                <img v-else class="user-profile" :src="file.festival.logo" alt="user">
<!--                                <router-link :to="{name: 'front_festivals_show',params : {slug : file.festival.slug}}">{{file.festival.title}}</router-link>-->
                                <a :href="'/festivals/show/'+file.festival.slug">{{file.festival.title}}</a>
                            </td>
                            <td><span class="badge bg-cyan3 font-13 p-2">{{file.code}}</span></td>
                            <td><span class="badge bg-pink font-13 p-2">{{file.type}}</span></td>
                            <td class="text-right" dir="ltr"><span class="badge bg-orange3 font-13 p-2">{{file.size}} KB</span></td>
                            <td>
                                <button @click="DownloadFile(file)" class="btn btn-success bg-green3 btn-sm manage-btn font-14">
                                    <i class="fas fa-download"></i> دریافت
                                </button>
                            </td>
                            <td>
                                <span class="btn bg-yellow3 font-13 text-dark">درحال برگزاری <i class="fas fa-spinner fa-spin"></i></span>
                            </td>
                            <td>
                               <span class="badge bg-dark p-2 font-13">{{file.created_at | filter_date}}</span>
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
import Manage_Nodata from "../../manage/Manage_Nodata";
import Manage_Loading from "../../manage/Manage_Loading";
import SweetAlert from "../../../helpers/SweetAlert";

export default {
    name: "Panel_Participate",
    components : {
        'manage_title' : Manage_Title,
        'manage_nodata' : Manage_Nodata,
        'manage_loading' : Manage_Loading
    },
    created() {
        this.GetAllItems();
    },
    data(){
        return {
            items:null,
            loading : true,
            search : '',

        }
    },
    methods :{
        GetAllItems(){
            axios.get('/api/panel/participate/all').then(response=>{
                this.items = response.data;
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
                docUrl.setAttribute('download', file.code+'.'+file.extension);
                document.body.appendChild(docUrl);
                docUrl.click();
            });
        }

    },
    computed :{
        DoSearchItems(){
            return  this.items.filter(item =>{

                return item.festival.title !== null && item.festival.title.match(this.search)
                    || item.code !== null && item.code.match(this.search);
            })

        }
    }


}
</script>

<style scoped>
.user-profile{
    width: 40px;
    margin-left: 5px!important;
}
</style>
