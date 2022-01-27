
// Vue.use(Vuex)
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export default new Vuex.Store({
	state: {
		listado_compras: []
	},
	mutations: {
		setCompras(state, data){
			state.listado_compras = data;
		}
	},
	actions: {
		obtenerListadoCompras({commit}, hola){
			axios.get('/compras').then(response => {
				commit('setCompras', response.data);
			}).catch( error => {
				console.error(error);
			});
		}
	}
})