import VueRouter from 'vue-router';

const routes = [
    { path: '/', name: 'index', component: require('./components/Index.vue') },
    { path: '/recode', name: 'recode', component: require('./components/Recode.vue') },
    { path: '/category', name: 'category', component: require('./components/Category.vue') },
//    { path: '/summary', name: 'summary', component: require('./components/Summary.vue') },
];

export default new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active',
});