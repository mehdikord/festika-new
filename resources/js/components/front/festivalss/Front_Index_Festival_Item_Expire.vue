<template>
    <div class="author-card ">
        <a class="img-fluid text-center">
            <img v-if="banner !== null" :src="banner"  alt="Images">
            <img v-else src="festika.svg" width="75%" alt="Images">
        </a>
        <div class="content pb-0">
            <div class="author-user">
                <img v-if="logo !== null" :src="logo" alt="Images">
                <img v-else src="template/images/svg/default-logo.png" alt="Images">
            </div>
            <h3 class="font-15"><a >{{ title }}</a></h3>
            <span>{{ category }}</span>
            <p class="mb-3 font-14">
                {{subtitle}}
            </p>
            <div class="text-center ">
                <span class="badge bg-orange3 p-3 text-light font-16"> 3 روز تا پایان</span>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Front_Index_Festival_Item_Expire",
    props:[
        'title',
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
