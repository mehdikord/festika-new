<template>

    <div class="top-sellers-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="section-title">
                        <h1 class="mt-4 text-aviny font-40">
                            برترین برگزارکنندگان
                        </h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="trending-btn text-end">
                        <router-link to="" class="default-btn border-radius-5">مشاهده همه برگزارکنندگان</router-link>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pt-45">

                <div v-for="(item,index) in items" class="col-lg-3 col-6 col-md-4">
                    <div class="top-sellers-item">

                        <div class="top-sellers-img">
                            <router-link to="">
                                <img v-if="item.profile !== null" :src="item.profile" alt="Images">
                                <img v-else src="/template/images/svg/user-default.png" alt="Images">
                            </router-link>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="content">
                            <h5 class="mb-4 font-17">
                                <router-link class="text-success" to="">{{  item.name  }}</router-link>
                            </h5>
                            <span class="text-bold-3 badge bg-red3 font-16">{{item.festivals.length}}</span><span class="mr-2">جشنواره</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Front_Index_Top_Users",

    created() {
        this.GetAllItems();

    },
    data(){
        return {
            items:{},
            item_loading : true,
        }

    },
    methods :{
        GetAllItems(){
            axios.get('/api/front/users/top').then(response =>{
                this.items = response.data;
                this.item_loading = false;
            }).catch(e =>{

                SweetAlert.SweetServerErrorMessage();
            })

        },


    }

}
</script>

<style scoped>
.mr-2{
    margin-right:10px!important;
}
</style>
