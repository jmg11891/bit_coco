<template>
	<div class="row justify-content-center">
		<div class="col md-5">
			<form-compra></form-compra>
		</div>
		<div class="col-md-7">
			<listado-compras v-for="compra in listado_compras" :key="compra.id" :compra="compra"></listado-compras>
			<div class="alert alert-warning" role="alert" v-if="listado_compras.length == 0">
				No se han registrado compras
			</div>
		</div>
	</div>
</template>

<script>
import {mapState} from 'vuex'
import {mapActions} from 'vuex'

export default {
	computed : {
		...mapState(['listado_compras'])
	},
	methods : {
		...mapActions({ obtenerListadoCompras: 'obtenerListadoCompras'})
	},
	created() {
		this.obtenerListadoCompras();

	}
}
</script>