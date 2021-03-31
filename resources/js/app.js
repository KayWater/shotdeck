/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);

import router from './routes.js';
import store from './store/index.js';

import './filters/index.js';

import moment from 'moment';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
/**
 * Async routes mapper
 */
// const whiteList = ['/', '/virtualstars', '/teams', '/administrator'];
const whiteList = store.state.routePermissions.routes.map((route) => route.path);

router.beforeEach((to, from, next) => {
    if (store.state.auth.accessToken) {
        if (to.path === '/') {
            next({ path: '/console' });
        } else {
            if (store.getters['users/roles'].length === 0) {
                // 刷新access_token
                if ( moment().isSameOrAfter(moment.unix(window.localStorage.getItem('expired_at'))) ) {
                    let refreshToken = window.localStorage.getItem('refresh_token');
                    if (refreshToken) {
                        store.dispatch('auth/refreshToken', refreshToken).then((response) => {
                            store.dispatch('users/getCurrentUser')
                            .then((response) => {
                                const roles = store.getters['users/roles'];
                                // generate routes
                                store.dispatch('routePermissions/generateRoutes', { roles })
                                .then(() => { // 生成可访问的路由表
                                    router.addRoutes(store.state.routePermissions.addRoutes) // 动态添加可访问路由表
                                    next({ ...to, replace: true }) // hack方法 确保addRoutes已完成 ,set the replace: true so the navigation will not leave a history record
                                });
                            }).catch(err => {
                                console.log(err);
                            });
                        }).catch((error) => {
                            next('/');
                        });
                    }
                } else {
                    store.dispatch('users/getCurrentUser')
                        .then((response) => {
                            const roles = store.getters['users/roles'];
                            // generate routes
                            store.dispatch('routePermissions/generateRoutes', { roles })
                            .then(() => { // 生成可访问的路由表
                                router.addRoutes(store.state.routePermissions.addRoutes) // 动态添加可访问路由表
                                next({ ...to, replace: true }) // hack方法 确保addRoutes已完成 ,set the replace: true so the navigation will not leave a history record
                            })
                        }).catch(err => {
                            console.log(err);
                        });
                }
            } else {
                next()
            }
        }
    } else if (store.state.adminAuth.accessToken) {
        if (to.path === '/administrator') {
            next({ path: '/administrator/dashboard' });
        } else {
            if (store.getters['administrators/roles'].length === 0) {
                // 刷新access_token
                if ( moment().isSameOrAfter(moment.unix(window.localStorage.getItem('admin_expired_at'))) ) {
                    let refreshToken = window.localStorage.getItem('admin_refresh_token');
                    if (refreshToken) {
                        store.dispatch('adminAuth/refreshToken', refreshToken).then((response) => {
                            store.dispatch('administrators/getCurrentUser')
                            .then((response) => {
                                const roles = store.getters['administrators/roles'];
                                // generate routes
                                store.dispatch('routePermissions/generateRoutes', { roles })
                                .then(() => { // 生成可访问的路由表
                                    router.addRoutes(store.state.routePermissions.addRoutes) // 动态添加可访问路由表
                                    next({ ...to, replace: true }) // hack方法 确保addRoutes已完成 ,set the replace: true so the navigation will not leave a history record
                                });
                            }).catch(err => {
                                console.log(err);
                            });
                        }).catch((error) => {
                            next('/');
                        });
                    }
                } else {
                    store.dispatch('administrators/getCurrentUser')
                        .then((response) => {
                            const roles = store.getters['administrators/roles'];
                            // generate routes
                            store.dispatch('routePermissions/generateRoutes', { roles })
                            .then(() => { // 生成可访问的路由表
                                router.addRoutes(store.state.routePermissions.addRoutes) // 动态添加可访问路由表
                                next({ ...to, replace: true }) // hack方法 确保addRoutes已完成 ,set the replace: true so the navigation will not leave a history record
                            })
                            
                        }).catch(err => {
                            console.log(err);
                        });
                }
            } else {
                next()
            }
        }
    } else {
        next()
        // if (whiteList.indexOf(to.path) !== -1) {
        //     // in the free login whitelist, go directly
        //     next()
        // } else {
        //     // other pages that do not have permission to access are redirected to the login page.
        //     next('/')
        // }
    }
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    store,
    el: '#app',
});