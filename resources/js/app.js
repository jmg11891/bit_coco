require('./bootstrap');


import Vue from 'vue'

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('compras', require('./components/compras/compras.vue').default);
Vue.component('form-compra', require('./components/compras/form-compra.vue').default);
Vue.component('listado-compras', require('./components/compras/listado-compras.vue').default);

import store from "./components/compras/storeCompras"


const app = new Vue({
    el: '#app',
    store: store
});
