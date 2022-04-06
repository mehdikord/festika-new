<template>
    <div class="author-card shadow">
        <router-link :to="{name:'front_festivals_show',params:{slug : slug}}">
            <img v-if="banner !== null" :src="banner"  alt="Images">
            <img v-else src="festika.svg" width="75%" alt="Images">
        </router-link>
        <div class="content pb-0">
            <div class="author-user">
                <img v-if="logo !== null" :src="logo" alt="Images">
                <img v-else src="template/images/svg/default-logo.png" alt="Images">
            </div>
            <h3 class="font-15"><router-link :to="{name:'front_festivals_show',params:{slug : slug}}" >{{title}}</router-link></h3>
            <span>{{category}}</span>
            <p class="font-14">
                {{subtitle}}
            </p>
            <div class="text-center mt-3">
                <router-link :to="{name:'front_festivals_show',params:{slug : slug}}"  class="btn bg-orange3 text-light font-16 text-bold-3 w-100">شرکت در جشنواره</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Front_Index_Festival_Item1",
    props:[
        'title',
        'slug',
        'category',
        'subtitle',
        'logo',
        'banner'

    ]
}
</script>

<style scoped>

</style>
