import VueRouter from "vue-router";
import Panel_Dashboard from "../components/dashboard/Panel_Dashboard";
import Panel_Profile from "../components/dashboard/Panel_Profile";

const routes = [
    //dashboard
    {
        path : '/panel/dashboard',
        component : Panel_Dashboard,
        name : 'panel_index',
    },
    {
        path : '/panel/profile',
        component : Panel_Profile,
        name : 'panel_profile',
    },

];

const router = new VueRouter({

    routes : routes,
    mode : 'history',
});

export default router;
