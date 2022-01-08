import { RouteRecordRaw } from 'vue-router';

const routes = [
   {
      path: '/',
      name: 'home',
      component: () => import(/* webpackChunkName: "home" */ '@/pages/Home/index.vue'),
   },
];

export const PublicRoutes: Array<RouteRecordRaw> = routes.map((route) => {
   const meta = {
      public: true,
   };
   return { ...route, meta };
});
