import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/Home.vue"),
    },
    {
        path: "/city/:name",
        component: () => import("./Pages/City.vue"),
        props: true
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});