import VueRouter from "vue-router";
import Panel_Dashboard from "../components/dashboard/Panel_Dashboard";
import Panel_Profile from "../components/dashboard/Panel_Profile";
import Panel_Festivals_New from "../components/dashboard/festivals/Panel_Festivals_New";
import Panel_Festivals from "../components/dashboard/festivals/Panel_Festivals";
import Panel_Festivals_Files from "../components/dashboard/festivals/Panel_Festivals_Files";
import Panel_Festivals_Manage from "../components/dashboard/festivals/Panel_Festivals_Manage";

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
        component : Panel_Festivals,
        name : 'panel_festivals',
    },
    {
        path : '/panel/festivals/files/:slug',
        component : Panel_Festivals_Files,
        name : 'panel_festivals_files',
    },
    {
        path : '/panel/festivals/manage/:slug',
        component : Panel_Festivals_Manage,
        name : 'panel_festivals_manage',
    },
    {
        path : '/panel/festivals/new',
        component : Panel_Festivals_New,
        name : 'panel_festivals_new',
    },


];

const router = new VueRouter({

    routes : routes,
    mode : 'history',
});

export default router;
