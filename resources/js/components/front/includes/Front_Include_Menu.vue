<template>

    <div class="navbar-area">

        <div class="mobile-responsive-nav">
            <div class="container-fluid">
                <div class="mobile-responsive-menu">
                    <div class="logo">
                        <router-link :to="{name : 'front_index'}"  >
                            <img src="festika.svg" width="45" alt="logo">
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="desktop-nav desktop-nav-one nav-area">

            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <router-link :to="{name : 'front_index'}" class="navbar-brand">
                        <img src="/festika.svg" width="80" >
                    </router-link>
                    <div class="nav-widget-form">
                        <form class="search-form">
                            <input type="search" class="form-control" placeholder="جستجو جشنواره ... ">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse mean-menu" :id="'navbarSupportedContent'">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <router-link :to="{name:'front_index'}" class="nav-link" :class="{'active' : this.$route.name === 'front_index'}">
                                    صفحه اصلی
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link " :class="{'active' : this.$route.name === 'front_festivals'}">
                                    جشنواره ها
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <router-link :to="{name:'front_festivals'}" class="nav-link">
                                            همه جشنواره ها
                                        </router-link>
                                    </li>
                                    <li v-for="(category,index) in festival_categories" :key="index" class="nav-item">
                                        <router-link to="" class="nav-link">
                                            {{ category.name }}
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name : 'front_shop'}" href="" class="nav-link">
                                    فروشگاه هدایا
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name:'front_contact'}" class="nav-link" :class="{'active' : this.$route.name === 'front_contact'}">
                                    ارتباط با ما
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name : 'front_guide'}" href="" class="nav-link">
                                    راهنما
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link :to="{name:'front_terms'}" class="nav-link" :class="{'active' : this.$route.name === 'front_terms'}">
                                    قوانین و مقررات
                                </router-link>
                            </li>
                        </ul>
                        <div class="others-options">
                            <ul class="optional-item-list">
                                <li v-if="!this.UserAuthCheck()">
                                    <router-link :to="{name:'front_login'}"  :class="{'active' : this.$route.name === 'front_login'}">
                                        <i class="fas fa-sign-in-alt"></i> ورود به حساب
                                    </router-link>
                                </li>
                                <li v-else>
                                    <a href="/panel/dashboard">
                                        <i class="fas fa-user"></i> پنل کاربری
                                    </a>
                                </li>
                                <li v-if="!this.UserAuthCheck()">
                                    <router-link :to="{name : 'front_register'}"  :class="{'active' : this.$route.name === 'front_register'}">
                                        <i class="fas fa-user-plus"></i> ثبت نام
                                    </router-link>
                                </li>
                                <li v-else-if="this.UserAuthGet().role && this.UserAuthGet().role < 4">
                                    <a  href="/manage/dashboard"><i class="fas fa-cog"></i> پنل مدیریت </a>
                                </li>
                                <li v-else>
                                    <a href="#" class="text-light" @click="AuthLogout">
                                        خروج از حساب
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="mobile-nav">
            <div class="search-btn">
                <a class="#" href="#searchmodal" data-bs-toggle="modal" data-bs-target="#searchmodal">
                    <i class="fas fa-search"></i>
                </a>
            </div>
        </div>

        <div class="side-nav-responsive">
            <div class="container-max">
                <div class="dot-menu dot-menu-mt">
                    <div class="circle-inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>
                <div class="container container-mt">
                    <div class="side-nav-inner">
                        <div class="side-nav justify-content-center align-items-center">
                            <div class="side-nav-item">
                                <ul class="optional-item-list">

                                    <li v-if="!this.UserAuthCheck()">
                                        <router-link :to="{name:'front_login'}"  :class="{'active' : this.$route.name === 'front_login'}">
                                            <i class="fas fa-sign-in-alt"></i> ورود به حساب
                                        </router-link>
                                    </li>
                                    <li v-else>
                                        <a href="/panel/dashboard">
                                            <i class="fas fa-user"></i> پنل کاربری
                                        </a>
                                    </li>
                                    <li v-if="!this.UserAuthCheck()">
                                        <router-link :to="{name : 'front_register'}"  :class="{'active' : this.$route.name === 'front_register'}">
                                            <i class="fas fa-user-plus"></i> ثبت نام
                                        </router-link>
                                    </li>
                                    <li v-else-if="this.UserAuthGet().role && this.UserAuthGet().role < 4">
                                        <a  href="/manage/dashboard"><i class="fas fa-cog"></i> پنل مدیریت </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "Front_Include_Menu",
    created() {
      this.GetFestivalCategories();
    },
    data(){
        return {
            festival_categories : [],
        }
    },
    methods :{
        GetFestivalCategories(){
            axios.get('/api/front/festivals/categories').then(res=>{
                this.festival_categories = res.data;
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            })
        },
        AuthLogout(){
            this.UserAuthLogout()
        }
    }
}
</script>

<style scoped>

</style>
