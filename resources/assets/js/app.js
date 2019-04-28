
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import {Form, HasError, AlertError } from 'vform';
import VueProgressBar from 'vue-progressbar';
import VueRouter from 'vue-router';
import sweetAlert from 'sweetalert2';
import Gate from "./Gate";
import Datetime from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';
import VeeValidate from 'vee-validate';
import Vue from 'vue'
import Vuetify from 'vuetify'
// index.js or main.js


//Gate
Vue.prototype.$gate = new Gate(window.user);

//Vuetify
Vue.use(Vuetify)

//vform
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//Date Time
Vue.use(Datetime)
//to format date time
Vue.use(require('vue-moment'));
//form v-validation
Vue.use(VeeValidate)

//vue-router
Vue.use(VueRouter)
let routes = [
    { path: '/home',component: require('./components/dashboard.vue')},

    { path: '/dashboard',component: require('./components/dashboard.vue')},
    { path: '/developer',component: require('./components/Developer.vue')},
    { path: '/users',component: require('./components/Users.vue')},
    { path: '/suppliers',component: require('./components/Suppliers.vue')},
    { path: '/agents',component: require('./components/Agents.vue')},
    { path: '/tasks',component: require('./components/Tasks.vue')},
    { path: '/supplier',component: require('./components/Suppliers.vue')},
    { path: '/supplies',component: require('./components/Supplies.vue')},
    { path: '/material',component: require('./components/Material.vue')},
    { path: '/projects',component: require('./components/Project.vue')},
    { path: '/profile',component: require('./components/profile.vue')},
    { path: '/snacks',component: require('./components/Snacks.vue')},
    { path: '*',component: require('./components/NotFound.vue')}
]
const router = new VueRouter({
    mode:'history',
    routes
})

//Refresh component set up
//let Fire = new Vue();
//window.Fire = Fire;
//OR
window.Fire = new Vue();

//filter
Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('myDate', function(created){
    //return moment(created).format('MMMM Do YYYY , h:mm:ss a');
    return moment(created).format('MMMM Do YYYY');

});

Vue.filter('current_date', function(created){
    //return moment(created).format('MMMM Do YYYY , h:mm:ss a');
    return moment(created).fromNow();

});

Vue.filter('myDateTime', function(created){
    //return moment(created).format('MMMM Do YYYY , h:mm:ss a');
    return moment(created).format('MMMM Do YYYY hh:mm');

});
//vue-progressbar
Vue.use(VueProgressBar,{
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

//sweetalert2
window.sweetAlert = sweetAlert;
const toast = sweetAlert.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('passport-clients',require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue'));
Vue.component('not-found',require('./components/NotFound.vue'));

//Pagination
Vue.component('pagination', require('laravel-vue-pagination'));


Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    data:{
        search: ''
    },
    methods:{
        searchit(){
            console.log('appjs');
            Fire.$emit('searching');

        },
        printme(){
            window.print();
        }
    }
});


