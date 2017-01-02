/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

var Vue = require('vue')
var VueRouter = require('vue-router');
Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
Vue.use(VueRouter);

import Tasks from './components/Tasks.vue';
import Create from './components/Create.vue';
import template from './components/initials/template.vue'
import Example from './components/Example.vue';
import NotFoundComponent from './components/NotFoundComponent.vue';
const UserTask = Tasks
const UserCreate = Create
Vue.component('example', require('./components/Example.vue'))

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
             {path: '/create', component: UserCreate},
             {path: '', component: UserTask},
             { path: '*', component: NotFoundComponent }
            ]
})


new Vue(Vue.util.extend({router}, Example)).$mount('#app')
