<template>
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">مدیریت</li>

                    <li>
                        <router-link :to="{name : 'manage_index'}">
                            <i class="fas fa-dashboard"></i>
                            <span data-key="t-dashboard">داشبورد</span>
                        </router-link>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="menu-title" data-key="t-menu">مدیران و کاربران</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="fas fa-user-tie"></i>
                            <span data-key="t-apps">مدیران وبسایت</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <router-link :to="{name : 'manage_users_managers_create'}">
                                    <span data-key="t-calendar">مدیر جدید</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name : 'manage_users_managers'}">
                                    <span data-key="t-calendar">لیست مدیران</span>
                                </router-link>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="fas fa-users"></i>
                            <span data-key="t-apps">کاربران وبسایت</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <router-link :to="{name : 'manage_users_members_create'}">
                                    <span data-key="t-calendar">کاربر جدید</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name : 'manage_users_members'}">
                                    <span data-key="t-calendar">لیست کاربران</span>
                                </router-link>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li class="menu-title" data-key="t-menu">مدیریت جشنواره ها</li>
                    <li>
                        <router-link :to="{name : 'manage_festival_categories'}">
                            <i class="fas fa-list-alt"></i>
                            <span data-key="t-dashboard">دسته بندی ها</span>
                        </router-link>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="fas fa-gifts"></i>

                            <span data-key="t-apps">جشنواره ها</span>
                            <span class="badge rounded-pill bg-red3  float-end text-bold-3 font-13">7</span>

                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <hr>
                            <li>
                                <router-link :to="{name : 'manage_festival_create'}">
                                    <span data-key="t-calendar">ایجاد جشنواره جدید</span>
                                </router-link>
                            </li>
                            <hr>
                            <li>
                                <router-link :to="{name : 'manage_festival_create'}">
                                    <span data-key="t-calendar">در انتظار تائید</span>
                                    <span class="badge rounded-pill bg-orange3  float-end text-bold-3 font-13">7</span>
                                </router-link>
                            </li>
                            <hr>

                            <li>
                                <router-link :to="{name : 'manage_festivals'}">
                                    <span data-key="t-calendar">جشنواره های فعال</span>
                                </router-link>
                            </li>
                            <hr>

                            <li>
                                <router-link :to="{name : 'manage_festivals_expire'}">
                                    <span data-key="t-calendar">جشنواره های  پایان یافته</span>
                                </router-link>
                            </li>

                        </ul>
                    </li>


                </ul>

            </div>
            <!-- Sidebar -->
        </div>
    </div>
</template>

<script>
export default {
    name: "Manage_Menu"
}
</script>

<style scoped>

</style>
