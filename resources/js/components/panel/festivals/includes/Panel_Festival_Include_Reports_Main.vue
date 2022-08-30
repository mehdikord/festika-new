<template>
    <div class="card">
        <div class="card-body bg-success text-light">
            <div class="font-18 text-bold-3">گزارش کلی جشنواره</div>
        </div>
        <div class="card-body" >
            <festival_reports_file_type :festival="festival" class="app-fade-in"></festival_reports_file_type>

        </div>
    </div>
</template>

<script>

import Panel_Festival_Report_File_Type from "./reports/Panel_Festival_Report_File_Type";

export default {
    name: "Panel_Festival_Include_Reports_Main",
    props : ['festival'],
    components : {
        'festival_reports_file_type' : Panel_Festival_Report_File_Type,

    }




}
</script>

<style scoped>

.hello {
    width: 100%;
    height: 500px;
}
</style>
