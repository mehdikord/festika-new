<template>
    <div class="author-area author-area-bg pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2 class="text-aviny font-50 text-light"><span><img src="template/images/svg/default-logo.png" width="70" alt=""></span> حواست باشه این جایزه هارو از دست ندی !</h2>
                        <h1 class="text-light text-aviny font-35">جشنواره های درحال اتمام فستیکا</h1>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="author-btn text-end">
                        <router-link :to="{name : 'front_festivals'}" class="default-btn border-radius-5">مشاهده همه جشنواره ها</router-link>
                    </div>
                </div>
            </div>
            <div class="row pt-45 justify-content-center">
                <div v-for="(item,index) in items" :key="index" class="col-md-3">
                    <festival-expire-item :slug="item.slug" :title="item.title" :category="item.category.name" :subtitle="item.subtitle" :logo="item.logo" :banner="item.banner"></festival-expire-item>
                </div>

            </div>
        </div>
        <div class="author-area-shape">
            <img src="template/images/author/author-shape.png" alt="Images">
        </div>
    </div>
</template>

<script>
import Front_Index_Festival_Item_Expire from "../festivalss/Front_Index_Festival_Item_Expire";

export default {
    name: "Front_Index_Expire",
    components : {

        'festival-expire-item' : Front_Index_Festival_Item_Expire,

    },
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
            axios.get('/api/front/festivals/expiring').then(response =>{
                this.items = response.data;
                this.item_loading = false;
            }).catch(e =>{

                SweetAlert.SweetServerErrorMessage();
            })


        }

    }
}
</script>

<style scoped>

</style>
