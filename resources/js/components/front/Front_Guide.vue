<template>
    <div>
        <div class="inner-banner inner-bg12">
            <div class="container">
                <div class="inner-title">
                    <h1 class="text-aviny text-light font-50">راهنما فستیکا</h1>
                    <ul>
                        <li>
                            <router-link :to="{name : 'front_index'}">
                                صفحه اصلی
                            </router-link>
                        </li>
                        <li>راهنما</li>
                    </ul>
                    <div class="inner-shape">
                        <img src="template/images/inner-banner/inner-shape1.png" alt="Images">
                        <img src="template/images/inner-banner/inner-shape2.png" alt="Images">
                    </div>
                </div>
            </div>
        </div>
        <index_guide></index_guide>
    </div>

</template>

<script>
import Front_Index_Guide from "./index/Front_Index_Guide";

export default {
    name: "Front_Guide",
    components : {
        'index_guide' : Front_Index_Guide
    }
}
</script>

<style scoped>

</style>
