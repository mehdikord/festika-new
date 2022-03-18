<template>
    <div>
        <front-index-top class="app-fade-in"></front-index-top>

        <front-index-hot-festivals class="app-fade-in"></front-index-hot-festivals>

        <front-index-whatis class="app-fade-in"></front-index-whatis>
        <front-index-expire class="app-fade-in"></front-index-expire>
        <front-index-guide class="app-fade-in"></front-index-guide>
        <front-index-trust class="app-fade-in"></front-index-trust>
    </div>


</template>

<script>
import Front_Index_Top from "./index/Front_Index_Top";
import Front_Index_Hot_Festivals from "./index/Front_Index_Hot_Festivals";
import Front_Index_Whatis from "./index/Front_Index_Whatis";
import Front_Index_Expire from "./index/Front_Index_Expire";
import Front_Index_Guide from "./index/Front_Index_Guide";
import Front_Index_Trust from "./index/Front_Index_Trust";

export default {
    name: "Front_Index",
    components : {
        'front-index-top' : Front_Index_Top,
        'front-index-hot-festivals' : Front_Index_Hot_Festivals,
        'front-index-whatis' : Front_Index_Whatis,
        'front-index-expire' : Front_Index_Expire,
        'front-index-guide' : Front_Index_Guide,
        'front-index-trust' : Front_Index_Trust,
    }
}
</script>

<style scoped>

</style>
