import VueRouter from "vue-router";
import Manage_Dashboard from "../components/manage/dashboard/Manage_Dashboard";
import Manage_Managers from "../components/manage/managers/Manage_Managers";
import Manage_Managers_Create from "../components/manage/managers/Manage_Managers_Create";
import Front_Login from "../components/front/Front_Login";
import Manage_Managers_Edit from "../components/manage/managers/Manage_Managers_Edit";
import Manage_Members from "../components/manage/members/Manage_Members";
import Manage_Members_Create from "../components/manage/members/Manage_Members_Create";
import Manage_Members_Edit from "../components/manage/members/Manage_Members_Edit";
import Manage_Festivals_Categories from "../components/manage/festivals/Manage_Festivals_Categories";
import Manage_Festivals_Categories_Edit from "../components/manage/festivals/Manage_Festivals_Categories_Edit";
import Manage_Festival_Create from "../components/manage/festivals/Manage_Festival_Create";
import Manage_Festivals from "../components/manage/festivals/Manage_Festivals";
import Manage_Festivals_Expire from "../components/manage/festivals/Manage_Festivals_Expire";
import Manage_Festivals_Waiting from "../components/manage/festivals/Manage_Festivals_Waiting";

const routes = [
    {
        path : '/manage/dashboard',
        name : 'manage_index',
        component : Manage_Dashboard,
    },
    {
        path : '/login',
        name : 'front_login',
        component : Front_Login,
    },

    //users
    {
        path : '/manage/users/managers',
        name : 'manage_users_managers',
        component : Manage_Managers,
    },
    {
        path : '/manage/users/managers/create',
        name : 'manage_users_managers_create',
        component : Manage_Managers_Create,
    },
    {
        path : '/manage/users/managers/edit/:id',
        name : 'manage_users_managers_edit',
        component : Manage_Managers_Edit,
    },

    {
        path : '/manage/users/members',
        name : 'manage_users_members',
        component : Manage_Members,
    },
    {
        path : '/manage/users/members/create',
        name : 'manage_users_members_create',
        component : Manage_Members_Create,
    },
    {
        path : '/manage/users/members/edit/:id',
        name : 'manage_users_members_edit',
        component : Manage_Members_Edit,
    },

    //Festivals
    {
        path : '/manage/festivals/categories',
        name : 'manage_festival_categories',
        component : Manage_Festivals_Categories,
    },
    {
        path : '/manage/festivals/categories/edit/:id',
        name : 'manage_festival_categories_edit',
        component : Manage_Festivals_Categories_Edit,
    },

    {
        path : '/manage/festivals/create',
        name : 'manage_festival_create',
        component : Manage_Festival_Create,
    },
    {
        path : '/manage/festivals',
        name : 'manage_festivals',
        component : Manage_Festivals,
    },
    {
        path : '/manage/festivals/expire',
        name : 'manage_festivals_expire',
        component : Manage_Festivals_Expire,
    },
    {
        path : '/manage/festivals/waiting',
        name : 'manage_festivals_waiting',
        component : Manage_Festivals_Waiting,
    },


];

const router = new VueRouter({
    routes : routes,
    mode : 'history'
});

export default router;
