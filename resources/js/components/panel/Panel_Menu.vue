<template>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li>
                        <router-link :to="{name : 'panel_index'}">
                            <i class="fas fa-dashboard"></i>
                            <span data-key="t-dashboard">داشبورد</span>
                        </router-link>
                    </li>
                    <li class="menu-title text-danger" data-key="t-menu">جشنواره های شما</li>
                    <li>
                        <router-link :to="{name : 'panel_festivals_new'}">
                            <i class="fas fa-plus-circle"></i>
                            <span data-key="t-dashboard">برگزاری جشنواره جدید</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name : 'panel_festivals'}">
                            <i class="fas fa-list"></i>
                            <span data-key="t-dashboard">جشنواره های شما</span>
                        </router-link>
                    </li>
                    <li class="menu-title text-danger" data-key="t-menu">جشنواره هایی که شما شرکت کرده اید</li>
                    <li>
                        <router-link :to="{name : 'panel_participate'}">
                            <i class="fas fa-gifts"></i>
                            <span data-key="t-dashboard">جشنواره های شرکت کرده</span>
                        </router-link>
                    </li>

                </ul>

            </div>
            <!-- Sidebar -->
        </div>
    </div>
</template>

<script>
export default {
    name: "Manage_Menu",

}
</script>

<style scoped>

</style>
