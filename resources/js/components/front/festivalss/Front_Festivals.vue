<template>
    <div>

        <div class="inner-banner inner-bg3">
            <div class="container">
                <div class="inner-title">
                    <h1 class="text-aviny text-light font-50">همه جشنواره های در حال برگزاری</h1>

                    <ul>
                        <li>
                            <router-link :to="{name : 'front_index'}">
                                صفحه اصلی
                            </router-link>
                        </li>
                        <li>همه جشنواره ها</li>
                    </ul>
                    <div class="inner-shape">
                        <img src="template/images/inner-banner/inner-shape1.png" alt="Images">
                        <img src="template/images/inner-banner/inner-shape2.png" alt="Images">
                    </div>
                </div>
            </div>
        </div>
        <div class="discover-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h3 class="font-24">جشنواره های فستیکا</h3>
                </div>
                <div class="row pt-45">
                    <div class="col-lg-3">
                        <div class="side-bar-area pl-20">
                            <div class="side-bar-widget">
                                <h3 class="title">Sort By</h3>
                                <div class="form-group select-group">
                                    <select class="form-select form-control">
                                        <option data-display='Sort By (Default)'>Sort By (Default)</option>
                                        <option value="1"> Top Rate</option>
                                        <option value="2">Mid Rate</option>
                                        <option value="3">Low Rated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="side-bar-widget-categories">
                                <h3 class="title">دسته بندی ها</h3>
                                <ul>
                                    <li v-for="(category,index) in festival_categories" :key="index">
                                        {{ category.name }}
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div v-if="festivals.length > 0" class="row ">
                            <div v-for="(festival,index) in festivals" :key="index" class="col-lg-4 col-md-6">
                                <front-festival-main class="app-fade-in shadow"
                                                     :title="festival.title"
                                                     :slug="festival.slug"
                                                     :category="festival.category.name"
                                                     :banner="festival.banner"
                                                     :logo="festival.logo"
                                                     :start_date="festival.start_at | filter_date()"
                                                     :end_date="festival.expire_at | filter_date()"
                                                     :user_name="festival.user.name"
                                                     :user_image="festival.user.profile"
                                ></front-festival-main>
                            </div>
                        </div>
                        <front-nodata v-else message="متاسفانه درحال حاضر هیچ جشنواره ای فعال نیست"></front-nodata>
                    </div>


                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Front_NoData from "../includes/Front_NoData";
import Front_Festival_Item_Main from "./Front_Festival_Item_Main";

export default {
    name: "Front_Festivals",
    components : {
      'front-nodata' : Front_NoData,
        'front-festival-main' : Front_Festival_Item_Main,
    },
    created() {
      this.GetFestivalCategories();
      this.GetFestivals();
    },
    data(){
        return {
            festival_categories : [],
            festivals : [],
        }
    },
    methods :{
        GetFestivalCategories(){
            axios.get('/api/front/festivals/categories').then(res=>{
                this.festival_categories = res.data;
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            })
        },
        GetFestivals(){
            axios.get('/api/front/festivals/all').then(res=>{
                this.festivals = res.data;
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            })
        }
    }
}
</script>

<style scoped>

</style>
