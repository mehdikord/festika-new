<template>
    <div class="container-fluid app-fade-in">
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
                        <a href="" class="nav-link">
                            فروشگاه هدایا
                        </a>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'front_contact'}" class="nav-link" :class="{'active' : this.$route.name === 'front_contact'}">
                            ارتباط با ما
                        </router-link>
                    </li>
                    <li class="nav-item">

                        <a href="#" class="nav-link">
                            راهنما فستیکا

                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <router-link to="" class="nav-link">
                                    شرکت در جشنواره
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="" class="nav-link">
                                    ایجاد جشنواره
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="" class="nav-link">
                                    مشاهده آثار جشنواره شما
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="" class="nav-link">
                                    مشاهده جشنواره های شرکت شده
                                </router-link>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            بلاگ
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <router-link to="" class="nav-link">
                                    همه نوشته ها
                                </router-link>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'front_contact'}" class="nav-link" :class="{'active' : this.$route.name === 'front_contact'}">
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
                            <router-link :to="{name : 'front_register'}" >
                                خروج از حساب
                            </router-link>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
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

        }
    }
}
</script>

<style scoped>

</style>
