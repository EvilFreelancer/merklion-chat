import Boot from './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

// Main application
import App from './App';
import Rooms from './components/Rooms'
import Chat from './components/Chat'

Vue
    .use(VueRouter)
    .use(VueResource);

// Default configs
Vue.prototype.API = 'http://localhost/api';

const routes = [
    {path: '/rooms', component: Rooms},
    {path: '/rooms/:room_id', component: Chat, props: true},
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

new Vue({
    router: router,
    render: h => h(App)
}).$mount('#app-chat');
