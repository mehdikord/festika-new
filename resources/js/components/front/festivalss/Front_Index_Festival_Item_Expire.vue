<template>
    <div class="author-card ">
        <router-link :to="{name:'front_festivals_show',params:{slug : slug}}" class="img-fluid text-center">
            <img v-if="banner !== null" :src="banner"  alt="Images">
            <img v-else src="festika.svg" width="75%" alt="Images">
        </router-link>
        <div class="content pb-0">
            <div class="author-user">
                <img v-if="logo !== null" :src="logo" alt="Images">
                <img v-else src="template/images/svg/default-logo.png" alt="Images">
            </div>
            <h3 class="font-15"><router-link :to="{name:'front_festivals_show',params:{slug : slug}}" >{{ title }}</router-link></h3>
            <span>{{ category }}</span>
            <p class="mb-3 font-14">
                {{subtitle}}
            </p>
            <div class="text-center ">
                <router-link :to="{name:'front_festivals_show',params:{slug : slug}}" class="badge bg-orange3 p-3 text-light font-16">شرکت در جشنواره</router-link>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Front_Index_Festival_Item_Expire",
    props:[
        'title',
        'slug',
        'subtitle',
        'category',
        'time',
        'logo',
        'banner'
    ]
}
</script>

<style scoped>

</style>
