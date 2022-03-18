<template>
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="management/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="management/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">فستیکا</span>
                    </span>
                </a>
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="management/images/logo-sm.svg" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="management/images/logo-sm.svg" alt="" height="24">
                        <span class="logo-txt">فستیکا</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" :id="'vertical-menu-btn'">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
<!--            e-->
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" :id="'page-header-search-dropdown'" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i  class="fas fa-search icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

<!--                    <form class="p-3">-->
<!--                        <div class="form-group m-0">-->
<!--                            <div class="input-group">-->
<!--                                <input type="text" class="form-control" placeholder="جستجو ..." aria-label="Search Result">-->

<!--                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
                </div>
            </div>


            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" :id="'mode-setting-btn'">
                    <i :data-feather="'moon'" class="fas fa-moon layout-mode-dark font-20 text-dark"></i>
                    <i :data-feather="'sun'" class="fas fa-sun layout-mode-light font-20 text-warning"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" :id="'page-header-notifications-dropdown'" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i  class="fas fa-bell"></i>
                    <span class="badge bg-danger rounded-pill">5</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> اعلانات </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline"> جدید (3)</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="management/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hourago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>مشاهده همه ..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" :id="'page-header-user-dropdown'" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user font-22 text-primary"></i>
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">نام کاربر</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href=""><i
                        class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> پروفایل</a>
                    <a class="dropdown-item" href=""><i
                        class="mdi mdi-lock font-size-16 align-middle me-1"></i> پشتیبانی</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href=""><i
                        class="mdi mdi-logout font-size-16 align-middle me-1"></i> خروج از حساب</a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Manage_Header",

}
</script>

<style scoped>

</style>
