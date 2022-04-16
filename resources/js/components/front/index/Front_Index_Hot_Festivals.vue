<template>
    <div v-if="items.length > 0" class="author-area-two author-area-bg3 pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8">
                    <div class="section-title">
                        <h1 class="text-aviny text-danger font-50">جشنواره های ویژه درحال برگزاری</h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="author-btn text-end"></div>
                </div>
            </div>
            <div class="row pt-45 justify-content-center">

                <div v-for="(item,index) in items" :key="index" class="col-md-3">
                    <front-index-festival-item1 class="app-fade-in" :slug="item.slug" :title="item.title" :category="item.category.name" :subtitle="item.subtitle" :logo="item.logo" :banner="item.banner"> </front-index-festival-item1>
                </div>

            </div>
        </div>
        <div class="author-area-shape-two">
            <img src="template/images/author/author-shape2.png" alt="Images">
        </div>
    </div>

</template>

<script>
import Front_Index_Festival_Item1 from "../festivalss/Front_Index_Festival_Item1";

export default {
    name: "Front_Index_Hot_Festivals",
    components : {
        'front-index-festival-item1' : Front_Index_Festival_Item1,
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
            axios.get('/api/front/festivals/specials').then(response =>{
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
