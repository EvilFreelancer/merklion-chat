import Boot from './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

// Main application
import App from './App';
import Rooms from './components/Rooms'

Vue
   // .use(BootstrapVue)
    .use(VueRouter)
    .use(VueResource);

// Default configs
Vue.prototype.API = 'http://localhost/api';

const routes = [
    {path: '/rooms', component: Rooms},
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

new Vue({
    router: router,
    render: h => h(App)
}).$mount('#app-chat');
