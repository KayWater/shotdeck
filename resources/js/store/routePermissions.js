import { asyncRouterMap, constantRouterMap } from '../routes.js';

function hasPermission(roles, route) {
    if (route.meta && route.meta.roles) {
        return roles.some(role => route.meta.roles.indexOf(role) >= 0);
    } else {
        return true;
    }
}

export const routePermissions = {
    namespaced: true,

    state: {
        routes: constantRouterMap,
        addRoutes: []
    },

    mutations: {
        SET_ROUTES: (state, routes) => {
            state.addRoutes = routes;
            state.routes = constantRouterMap.concat(routes);
        },

        RESET_ROUTES: (state) => {
            state.routes = constantRouterMap;
        }
    },

    actions: {
        generateRoutes({ commit }, data) {
            return new Promise(resolve => {
                const { roles } = data;
                // deep copy asyncRouteMap 
                const localAsyncRouterMap = $.extend(true, [], asyncRouterMap);
                const accessedRoutes = localAsyncRouterMap.filter(v => {
                    if (roles.indexOf('super-admin') >= 0 ) {
                        return true;
                    }
                   
                    if (hasPermission(roles, v)) {
                        if (v.children && v.children.length > 0) {
                            v.children = v.children.filter(child => {
                                if (hasPermission(roles, child)) {
                                    return child;
                                }
                                return false;
                            });
                            return v;
                        } else {
                            return v;
                        }
                    }
                    return false;
                });
                commit('SET_ROUTES', accessedRoutes);
                resolve();
            });
        }
    }
}