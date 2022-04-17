import VueRouter from "vue-router";
import Panel_Festival_New from "../components/panel/festivals/Panel_Festival_New";
import Panel_Festival_All from "../components/panel/festivals/Panel_Festival_All";
import Panel_Profile from "../components/panel/profile/Panel_Profile";
import Panel_Festival_Files from "../components/panel/festivals/Panel_Festival_Files";
import Panel_Festivals_Manage from "../components/panel/festivals/Panel_Festival_Manage";
import Panel_Dashboard from "../components/panel/dashboard/Panel_Dashboard";

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
    {
        path : '/panel/festivals',
        component : Panel_Festival_All,
        name : 'panel_festivals',
    },
    {
        path : '/panel/festivals/files/:slug',
        component : Panel_Festival_Files,
        name : 'panel_festivals_files',
    },
    {
        path : '/panel/festivals/manage/:slug',
        component : Panel_Festivals_Manage,
        name : 'panel_festivals_manage',
    },
    {
        path : '/panel/festivals/new',
        component : Panel_Festival_New,
        name : 'panel_festivals_new',
    },


];

const router = new VueRouter({

    routes : routes,
    mode : 'history',
});

export default router;
