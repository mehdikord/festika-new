<template>
    <div class="menu">
        <ul>
            <li>
                <router-link :to="{name : 'panel_index'}" >
                    <span><i class="fas fa-desktop" :class="{'text-danger' : this.$route.name === 'panel_index'}"></i></span>
                    <span class="nav-text me-2">داشبورد</span>
                </router-link>
            </li>
            <li >
                <router-link :to="{name : 'panel_profile'}" >
                    <span><i class="fas fa-user-circle" :class="{'text-danger' : this.$route.name === 'panel_profile'}"></i></span>
                    <span class="nav-text me-2">پروفایل کاربری</span>
                </router-link>
            </li>
            <li class=" logout">
                <a href="">
                    <span><i class="fas fa-sign-out-alt text-danger"></i></span>
                    <span class="nav-text me-1">خروج</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Panel_Menu"
}
</script>

<style scoped>

</style>
