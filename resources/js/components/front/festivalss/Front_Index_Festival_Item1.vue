<template>
    <div class="author-card shadow">
        <a href="author-profile.html">
            <img v-if="banner !== null" :src="banner"  alt="Images">
            <img v-else src="festika.svg" width="75%" alt="Images">
        </a>
        <div class="content">
            <div class="author-user">
                <img v-if="logo !== null" :src="logo" alt="Images">
                <img v-else src="template/images/svg/default-logo.png" alt="Images">
            </div>
            <h3 class="font-15"><a >{{title}}</a></h3>
            <span>{{category}}</span>
            <p class="font-14">
                {{subtitle}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Front_Index_Festival_Item1",
    props:[
        'title',
        'category',
        'subtitle',
        'logo',
        'banner'

    ]
}
</script>

<style scoped>

</style>
