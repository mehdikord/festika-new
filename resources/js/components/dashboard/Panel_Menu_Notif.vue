<template>
    <div class="nav-item dropdown notification dropdown">
        <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
            <div class="notify-bell icon-menu">
                <span>
                    <i class="fas fa-bell"></i>
                </span>
            </div>
        </div>
        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu notification-list dropdown-menu dropdown-menu-right">
            <h4>Recent Notification</h4>
            <div class="lists">
                <a class="" href="dashboard/#">
                    <div class="d-flex align-items-center">
                        <span class="me-3 icon success">
                            <i class="fas fa-check"></i>
                        </span>
                        <div>
                            <p>Account created successfully</p><span>2020-11-04 12:00:23</span>
                        </div>
                    </div>
                </a>
                <a href="#">More<i class="ri-arrow-right-s-line"></i></a>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Panel_Menu_Notif"
}
</script>

<style scoped>

</style>
