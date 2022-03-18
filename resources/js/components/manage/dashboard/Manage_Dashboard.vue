<template>
    <div>
        <manage_title title="داشبورد مدیریت" ></manage_title>
        <in_main_info class="app-fade-in"></in_main_info>
        <in_users_files users_count="5" class="app-fade-in"></in_users_files>
    </div>
</template>

<script>
import Manage_Title from "../Manage_Title";
import Manage_Loading_Colors from "../Manage_Loading_Colors";
import Manage_Dashboard_Main_Info from "./includes/Manage_Dashboard_Main_Info";
import Manage_Dashboard_Users_Files from "./includes/Manage_Dashboard_Users_Files";

export default {
    name: "Manage_Dashboard",
    components: {
        'manage_title' : Manage_Title,
        'in_main_info' : Manage_Dashboard_Main_Info,
        'in_users_files' : Manage_Dashboard_Users_Files,
    },

}
</script>

<style scoped>

</style>
