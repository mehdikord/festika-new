<template>
    <div class="featured-card box-shadow">
        <div class="featured-card-img">
            <router-link :to="{name: 'front_festivals_show',params : {slug : slug}}">
                <img  v-if="banner !== null" :src="banner" width="100%"  alt="Images">
                <img v-else src="festika.svg" width="100%"  alt="Images">
            </router-link>
            <p>
                <img class="img-logo" v-if="logo === null" src="template/images/svg/default-logo.png" width="40" alt="">
                <img class="img-logo" v-else :src="logo" width="40" alt="">
            </p>
        </div>
        <div class="content content-info">
            <h1>
                <router-link :to="{name: 'front_festivals_show',params : {slug : slug}}" class="font-16 text-danger">
                    {{title}}
                </router-link>
            </h1>
            <h2 class="cat-text text-secondary font-13">{{category}}</h2>
            <div class="mb-2">
                <i class="fas fa-calendar font-18 text-success"></i><span class="font-13 text-bold-3"> شروع : </span>
                <span class="float-end font-14 text-bold-3 text-success">{{start_date}}</span>
            </div>
            <div class="mb-4">
                <i class="fas fa-calendar font-18 text-danger"></i><span class="font-13 text-bold-3"> پایان : </span>
                <span class="float-end font-14 text-bold-3 text-danger">{{end_date}}</span>
            </div>
            <router-link :to="{name: 'front_festivals_show',params : {slug : slug}}" class="default-btn border-radius-50 w-100">
                شرکت در جشنواره
            </router-link>
            <a href="" class="featured-user-option w-100">
                <img v-if="user_image !== null" :src="user_image"  alt="Images">
                <img v-else src="template/images/svg/user-default.png"  alt="Images">
                <span>{{ user_name }}</span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Front_Festival_Item_Main",
    props : ['title','slug','category','user_name','user_image','banner','logo','start_date','end_date']
}
</script>
<style scoped>
.img-logo{
    width: 60px!important;
    height: 60px!important;
    border-radius: 50%!important;
    border : 2px solid rgba(255, 84, 53, 0.76);
}
.cat-text{
    padding-top: 2px!important;
    padding-bottom: 10px!important;
}
.content-info{
    padding-top: 0px!important;
}

</style>
