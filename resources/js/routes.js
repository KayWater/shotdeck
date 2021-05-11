import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

export const constantRouterMap = [
    { 
        path: '/',
        component: Vue.component('App', require('./components/App.vue').default),
        name: 'home',
        meta: {
            title: 'HOME',
        },
        children : [
            
        ]
    },

    { 
        path: '/login',
        component: Vue.component('Login', require('./components/pages/auth/Login.vue').default),
        name: 'login',
        meta: {
            title: 'Login',
        },
    },

    { 
        path: '/register',
        component: Vue.component('Register', require('./components/pages/auth/Register.vue').default),
        name: 'register',
        meta: {
            title: 'Register',
        },
    },

    {
        path: '/shot/create',
        component: Vue.component('ShotCreate', require('./components/pages/shots/ShotCreate.vue').default),
        name: 'shot-create',
        meta: {
            title: 'ShotCreate',
        }
    },
    {
        path: '/shots/:id/edit',
        component: Vue.component('ShotEdit', require('./components/pages/shots/ShotEdit').default),
        name: 'shot-edit',
        meta: {
            title: 'ShotEdit',
        },
        props: true,
    },


    {
        path: '/search',
        component: Vue.component('Search', require('./components/pages/Search.vue').default),
        name: 'search',
        meta: {
            title: 'Search',
        },
    },

    {
        path: '/administrator/login',
        component: Vue.component('Login', require('./components/pages/administrators/auth/Login.vue').default),
        name: 'administrator-login',
        meta: {
            title: 'AdministratorLogin',
        }
    },

    {
        path: '/administrator/dashboard',
        component: Vue.component('Dashboard', require('./components/pages/administrators/Dashboard.vue').default),
        name: 'administrator-dashboard',
        meta: {
            title: 'AdministratorDashboard',
        }
    },

    {
        path: '/properties',
        component: Vue.component('PropertyIndex', require('./components/pages/properties/Index.vue').default),
        name: 'property-index',
        meta: {
            title: '属性管理',
            sidebar: true,
        },
        children: [
            {
                path: '',
                component: Vue.component('PropertyList', require('./components/pages/properties/List.vue').default),
                name: 'property-list',
                meta: {
                    title: '属性列表',
                    sidebar: true
                },
            },

            {
                path: 'create',
                component: Vue.component('PropertyCreate', require('./components/pages/properties/Create.vue').default),
                name: 'property-create',
                meta: {
                    title: '新建属性',
                }
            },

            {
                path: 'values',
                component: Vue.component('PropertyValues', require('./components/pages/properties/PropertyValues.vue').default),
                name: 'property-values',
                meta: {
                    title: '属性值列表',
                    sidebar: true,
                },
            },

            {
                path: ':id',
                component: Vue.component('PropertyShow', require('./components/pages/properties/PropertyShow.vue').default),
                name: 'property-show',
                meta: {
                    tile: '属性页面',
                },
                props: true
            },

            {
                path: ':id/values/create',
                component: Vue.component('PropertyValueCreate', require('./components/pages/properties/PropertyValueCreate.vue').default),
                name: 'property-value-create',
                meta: {
                    title: '添加属性值',
                },
                props: true
            },

            {
                path: ':pid/values/:vid',
                component: Vue.component('PropertyValueEdit', require('./components/pages/properties/PropertyValueEdit.vue').default),
                name: 'property-value-edit',
                meta: {
                    title: '编辑属性值',
                },
                props: true
            },

            
        ]
    },

    {
        path: '/movies/create',
        component: Vue.component('MovieCreate', require('./components/pages/movies/MovieCreate.vue').default),
        name: 'movie-create',
        meta: {
            title: 'movieCreate',
        },
    },

    {
        path: '/movies',
        component: Vue.component('MovieList', require('./components/pages/movies/MovieList.vue').default),
        name: 'movies',
        meta: {
            title: 'movieList',
        },
    },

    {
        path: '/movies/:id',
        component: Vue.component('MovieShow', require('./components/pages/movies/MovieShow.vue').default),
        name: 'movie-show',
        meta: {
            title: 'movieShow',
        },
        props: true
    },

    {
        path: '/movies/:id/edit',
        component: Vue.component('MovieEdit', require('./components/pages/movies/MovieEdit.vue').default),
        name: 'movie-edit',
        meta: {
            title: 'movieEdit',
        },
        props: true
    },

    {
        path: '/people/create',
        component: Vue.component('PeopleCreate', require('./components/pages/people/PeopleCreate').default),
        name: 'people-create',
        meta: {
            title: 'peopleCreate',
        }
    }
];

export default new VueRouter({
    routes: constantRouterMap
});

export const asyncRouterMap = [
    
    // {
    //     path: '/console/users',
    //     component: Vue.component('Console', require('./components/console/Console.vue').default),
    //     name: 'user-index',
    //     meta: {
    //         roles: ['super-admin'],
    //         title: '用户管理',
    //         sidebar: true,
    //     },
    //     children: [
    //         {
    //             path: 'create',
    //             component: Vue.component('UsersCreate', require('./components/views/users/UsersCreate.vue').default),
    //             name: 'user-create',
    //             meta: {
    //                 roles: ['super-admin'],
    //                 title: '创建用户',
    //                 sidebar: true,
    //             }
    //         },
    //         {
    //             path: 'list',
    //             component: Vue.component('UsersList', require('./components/views/users/UsersList.vue').default),
    //             name: 'user-list',
    //             meta: {
    //                 roles: ['super-admin'],
    //                 title: '用户列表',
    //                 sidebar: true,
    //             },
    //         },
    //         {
    //             path: ':id/edit',
    //             component: Vue.component('UserEdit', require('./components/views/users/UserEdit.vue').default),
    //             name: 'user-edit',
    //             meta: {
    //                 roles: ['super-admin'],
    //                 title: '用户编辑',
    //             },
    //             props: true,
    //         }
    //     ]
    // },

    // {
    //     path: '/console/departments',
    //     component: Vue.component('Console', require('./components/console/Console.vue').default),
    //     name: 'department-index',
    //     meta: {
    //         roles: ['super-admin'],
    //         title: '部门管理',
    //         sidebar: true,
    //     },
    //     children: [
    //         {
    //             path: 'lists',
    //             component: Vue.component('DepartmentList', require('./components/views/departments/DepartmentList.vue').default),
    //             name: 'lists',
    //             meta: {
    //                 roles: ['super-admin'],
    //                 title: '部门列表',
    //                 sidebar: true,
    //             },
    //         },
    //     ]
    // },

    // {
    //     path: '/console/evaluation',
    //     component: Vue.component('Console', require('./components/console/Console.vue').default),
    //     name: 'evaluation-index',
    //     meta: {
    //         roles: ['super-admin', '总经理'],
    //         title: '评估设置',
    //         sidebar: true,
    //     },
    //     children: [
    //         {
    //             path: 'items',
    //             component: Vue.component('EvaluationItems', require('./components/views/evaluation/Items.vue').default),
    //             name: 'evaluation-items',
    //             meta: {
    //                 roles: ['supper-admin', '总经理'],
    //                 title: '评估项目',
    //                 sidebar: true,
    //             },
    //         },
    //         {
    //             path: 'schemes',
    //             component: Vue.component('EvaluationSchemes', require('./components/views/evaluation/Schemes.vue').default),
    //             name: 'evaluation-schemes',
    //             meta: {
    //                 roles: ['super-admin', '总经理'],
    //                 title: '评估方案',
    //                 sidebar: true,
    //             },
    //         },
    //         {
    //             path: 'schemes/create',
    //             component: Vue.component('EvaluationSchemeCreate', require('./components/views/evaluation/SchemeCreate.vue').default),
    //             name: 'evaluation-scheme-create',
    //             meta: {
    //                 roles: ['super-admin', '总经理'],
    //                 title: '评估方案',
    //             },
    //             props: true,
    //         },
    //         {
    //             path: 'schemes/:id/edit',
    //             component: Vue.component('EvaluationSchemeEdit', require('./components/views/evaluation/SchemeEdit.vue').default),
    //             name: 'evaluation-scheme-edit',
    //             meta: {
    //                 roles: ['super-admin'],
    //                 title: '评估方案',
    //             },
    //             props: true,
    //         },
    //         {
    //             path: 'schemes/:id/show',
    //             component: Vue.component('EvaluationSchemeShow', require('./components/views/evaluation/SchemeShow.vue').default),
    //             name: 'evaluation-scheme-show',
    //             meta: {
    //                 roles: ['super-admin', '总经理'],
    //                 title: '评估方案',
    //             },
    //             props: true,
    //         },
    //     ]
    // },

    // {
    //     path: '/console/permission',
    //     component: Vue.component('Console', require('./components/console/Console.vue').default),
    //     name: 'permission-index',
    //     meta: {
    //         roles: ['super-admin'],
    //         title: '权限管理',
    //         sidebar: true,
    //     },
    //     children: [
    //         {
    //             path: 'permissions',
    //             component: Vue.component('Permissions', require('./components/views/permissions/Permissions.vue').default),
    //             name: 'permissions',
    //             meta: {
    //                 roles: ['super-sadmin'],
    //                 title: '权限列表',
    //                 sidebar: true,
    //             }
    //         },
    //         {
    //             path: 'roles',
    //             component: Vue.component('Roles', require('./components/views/permissions/Roles.vue').default),
    //             name: 'roles',
    //             meta: {
    //                 roles: ['super-admin'],
    //                 title: '角色列表',
    //                 sidebar: true,
    //             },
    //         }
    //     ]
    // },

];