import VueRouter from "vue-router";
import Front_Index from "../components/front/Front_Index";

const routes = [
    {
        path : '/',
        name : 'front_index',
        component : Front_Index,
    }

];

const router = new VueRouter({
    routes : routes,
    mode : 'history'
});

export default router;
