<template>
    <div class="row mt-4">
        <div class="col-md-3">
            <manage_loading_colors :size="116" v-if="total_managers === null"></manage_loading_colors>
            <div v-else class="card bg-primary border-primary text-white app-fade-in">
                <div class="card-body">
                    <h5 class="mb-3 text-white">مدیران فستیکا</h5>
                    <div class="p-1 float-end">
                        <h3 class="text-light">125 <span class="font-12">مدیر کل و مدیر داخلی</span> </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <manage_loading_colors :size="116" v-if="total_members === null"></manage_loading_colors>
            <div v-else class="card bg-cyan3 text-white app-fade-in">
                <div class="card-body">
                    <h5 class="mb-3 text-white">کاربران فستیکا</h5>
                    <div class="p-1 float-end">
                        <h3 class="text-light">12564 <span class="font-12">کاربر فعال فستیکا</span> </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <manage_loading_colors :size="116" v-if="total_festivals === null"></manage_loading_colors>
            <div v-else class="card bg-success border-success text-white app-fade-in">
                <div class="card-body">
                    <h5 class="mb-3 text-white">همه جشنواره</h5>
                    <div class="p-1 float-end">
                        <h3 class="text-light">89 <span class="font-12">جشنواره برگزارشده و درحال برگزاری</span> </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <manage_loading_colors :size="116" v-if="total_files === null"></manage_loading_colors>
            <div v-else class="card bg-danger border-danger text-white app-fade-in">
                <div class="card-body">
                    <h5 class="mb-3 text-white">آثار ارسال شده</h5>
                    <div class="p-1 float-end">
                        <h3 class="text-light">23651 <span class="font-12 text-bold-2">کل تعداد آثار ارسال شده</span> </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Manage_Loading_Colors from "../../Manage_Loading_Colors";

export default {
    name: "Manage_Dashboard_Main_Info",
    components : {
        'manage_loading_colors' : Manage_Loading_Colors,
    },
    created() {
        this.GetTotalItems();
    },
    data(){
        return {
            total_managers : null,
            total_members : null,
            total_festivals : null,
            total_files : null,
        }
    },
    methods : {
        GetTotalItems(){
            setTimeout(() => {
                this.total_managers = 16;
            }, 1000)
            setTimeout(() => {
                this.total_members = 1296;
            }, 1600)
            setTimeout(() => {
                this.total_festivals = 38;
            }, 1400)
            setTimeout(() => {
                this.total_files = 28956;
            }, 1900)
        }
    }
}
</script>

<style scoped>

</style>
