import Boot from './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
//import VueSocketIo from 'vue-socket.io';
//Vue.use(VueSocketIo, 'http://localhost:8080');

// Main application
import App from './App';
import Rooms from './components/Rooms'
import Chat from './components/Chat'

Vue
//.use(BootstrapVue)
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

// Vue.mixin({
//     data() {
//         return {
//             user: [],
//         };
//     },
//     methods: {
//         getUser: async function () {
//             const {data} = await axios.get(`/user/info`);
//             this.user = data[0];
//         }
//     },
//     mounted() {
//         this.getUser();
//     }
// });

new Vue({
    router: router,
    render: h => h(App)
}).$mount('#app-chat');
