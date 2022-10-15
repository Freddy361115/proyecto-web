// =========================================================
// * Vue Material Dashboard - v1.5.0
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vue-material-dashboard
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
// * Licensed under MIT (https://github.com/creativetimofficial/vue-material-dashboard/blob/master/LICENSE.md)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from "vue";
import VueRouter from "vue-router";
import App from "./App";
import PortalVue from 'portal-vue'

// router setup
import routes from "./routes/routes";
import axios from 'axios'
import vSelect from 'vue-select'

// Plugins
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import Notifications from "./components/NotificationPlugin";

// MaterialDashboard plugin
import MaterialDashboard from "./material-dashboard";
import BootstrapVue from 'bootstrap-vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(PortalVue)

import Chartist from "chartist";

// configure router
const router = new VueRouter({
    routes, // short for routes: routes
    linkExactActiveClass: "nav-item active",
});

Vue.prototype.$Chartist = Chartist;

Vue.use(VueRouter);
Vue.use(MaterialDashboard);
Vue.use(GlobalComponents);
Vue.use(GlobalDirectives);
Vue.use(Notifications);
Vue.component('v-select', vSelect)

Vue.prototype.$showNotification = function (type, message, icon) {
    this.$notify(
        {
            message: message,
            icon: icon,
            horizontalAlign: 'right',
            verticalAlign: 'top',
            type: type
        })
}

Vue.prototype.$getRequest = function (url) {
    return axios
        .get(url, {
            headers: {
                'Accept': 'application/json',
                'Authorization': "Bearer " + localStorage._token
            }
        })
        .then(result => {
            return result.data;
        })
        .catch(error => {
            if (error.response.status && error.response.status==401) {
                this.$showNotification('danger', 'Se requiere autenticacion.', 'add_alert');
                this.$router.push('login');    
            }
            else {
                this.$showNotification('danger', 'No se ha podido realizar la operacion.', 'add_alert');
                console.log(error);
            }
        })
}

Vue.prototype.$postRequest = function (url, params) {
    return axios
        .post(url, params, {
            headers: {
                'Accept': 'application/json',
                'Authorization': "Bearer " + localStorage._token
            }
        })
        .then(result => {
            return result.data;
        })
        .catch(error => {
            if (error.response.status==401) {
                this.$showNotification('danger', 'Se requiere autenticacion.', 'add_alert');
                this.$router.push('login');    
            }
            else {
                this.$showNotification('danger', 'No se ha podido realizar la operacion.', 'add_alert');
                console.log(error);
            }
        })
}

Vue.prototype.$putRequest = function (url, params) {
    return axios
        .put(url, params, {
            headers: {
                'Accept': 'application/json',
                'Authorization': "Bearer " + localStorage._token
            }
        })
        .then(result => {
            return result.data;
        })
        .catch(error => {
            if (error.response.status==401) {
                this.$showNotification('danger', 'Se requiere autenticacion.', 'add_alert');
                this.$router.push('login');    
            }
            else {
                this.$showNotification('danger', 'No se ha podido realizar la operacion.', 'add_alert');
                console.log(error);
            }
        })
}


Vue.prototype.$sendRequestFile = function (url, params) {
    return axios
        .post(url, params, {
            headers: {
                'Authorization': "Bearer " + localStorage._token,
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(result => {
            return result.data;
        })
        .catch(error => {
            if (error.response.status==401) {
                this.$showNotification('danger', 'Se requiere autenticacion.', 'add_alert');
                this.$router.push('login');    
            }
            else {
                this.$showNotification('danger', 'No se ha podido realizar la operacion.', 'add_alert');
                console.log(error);
            }
        })
}

Vue.prototype.$deleteRequest = function (url) {
    return axios
        .delete(url, {
            headers: {
                'Accept': 'application/json',
                'Authorization': "Bearer " + localStorage._token
            }
        })
        .then(result => {
            return result.data;
        })
        .catch(error => {
            if (error.response.status==401) {
                this.$showNotification('danger', 'Se requiere autenticacion.', 'add_alert');
                this.$router.push('login');    
            }
            else {
                this.$showNotification('danger', 'No se ha podido realizar la operacion.', 'add_alert');
                console.log(error);
            }
        })
}

/* eslint-disable no-new */
new Vue({
    el: "#app",
    render: (h) => h(App),
    router,
    data: {
        Chartist: Chartist,
    },
});
