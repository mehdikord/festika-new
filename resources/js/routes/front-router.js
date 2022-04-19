import VueRouter from "vue-router";
import Front_Index from "../components/front/Front_Index";
import Front_Register from "../components/front/Front_Register";
import Front_Login from "../components/front/Front_Login";
import Front_Contact from "../components/front/Front_Contact";
import Front_Festivals from "../components/front/festivalss/Front_Festivals";
import Front_Festival_Show from "../components/front/festivalss/Front_Festival_Show";
import Front_Terms from "../components/front/Front_Terms";
import Front_Shop_Index from "../components/front/shop/Front_Shop_Index";
import Front_Guide from "../components/front/Front_Guide";

const routes = [

    {
        path : '/',
        name : 'front_index',
        component : Front_Index,
    },
    {
        path : '/register',
        name : 'front_register',
        component : Front_Register,
    },
    {
        path : '/login',
        name : 'front_login',
        component : Front_Login,
    },
    {
        path : '/contact',
        name : 'front_contact',
        component : Front_Contact,
    },
    {
        path : '/terms',
        name : 'front_terms',
        component : Front_Terms,
    },
    {
        path : '/festivals',
        name : 'front_festivals',
        component : Front_Festivals,
    },
    {
        path : '/festivals/show/:slug',
        name : 'front_festivals_show',
        component : Front_Festival_Show,
    },
    {
        path : '/shop',
        name : 'front_shop',
        component : Front_Shop_Index,
    },
    {
        path : '/guide',
        name : 'front_guide',
        component : Front_Guide,
    },


];

const router = new VueRouter({
    routes : routes,
    mode : 'history'
});

export default router;
