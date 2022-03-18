import VueRouter from "vue-router";
import Front_Index from "../components/front/Front_Index";
import Front_Register from "../components/front/Front_Register";
import Front_Login from "../components/front/Front_Login";
import Front_Contact from "../components/front/Front_Contact";

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

];

const router = new VueRouter({
    routes : routes,
    mode : 'history'
});

export default router;
