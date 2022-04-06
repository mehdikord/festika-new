<template>
    <div class="dropdown profile_log dropdown">
        <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
            <div class="user icon-menu active">
                <span>
                    <i class="fas fa-user"></i>
                </span>
            </div>
        </div>
        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
            <div class="user-email">
                <div class="user">
                    <span class="thumb">
                        <img src="dashboard/images/profile/3.png" alt="">
                    </span>
                    <div class="user-info text-right">
                        <h5>{{UserAuthGet().name}}</h5>
                        <span class="mt-2">{{ UserAuthGet().email }}</span>
                    </div>
                </div>
            </div>
            <router-link class="dropdown-item" :to="{name : 'panel_profile'}">
                <i class="fas fa-user-alt"></i><span class="me-2">تنظیمات حساب</span>
            </router-link>
            <a class="dropdown-item logout" href="">
                <i class="fas fa-sign-out-alt"></i><span class="me-2">خروج از حساب</span>
            </a>
        </div>
    </div>

</template>

<script>
export default {
    name: "Panel_Menu_Profile"
}
</script>

<style scoped>

</style>
