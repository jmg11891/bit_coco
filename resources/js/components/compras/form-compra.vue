<template>
	<div class="card">
		<div class="card-header">listado de compras</div>
		<div class="card-body">
			<form action="" @submit.prevent="guardarCompra">
				<div class="form-group">
					<label for="nueva_compra">Nueva compra</label>
					<input type="text" class="form-control" name="nueva_compra" v-model.trim="titulo" required>
				</div>
				<div class="form-group">
					<label for="nueva_compra">Descripción</label>
					<input type="text" class="form-control" name="nueva_compra" v-model.trim="descripcion" required>
				</div>
				<div class="row">
					<div class="col-12">
						<button class="btn btn-success float-right">Registrar compra</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>

import {mapActions} from 'vuex'

export default {
	data (){
		return {
			titulo: '',
			descripcion: ''
		}
	},
	methods: {
		...mapActions({ obtenerListadoCompras: 'obtenerListadoCompras'}),
		vaciarForm(){
			this.titulo = "";
			this.descripcion = "";
		},
		guardarCompra(){
			if(this.titulo == ""){
				alert('Debe diligenciar el campo Título.');
				return false;
			}
			if(this.descripcion == ""){
				alert('Debe diligenciar el campo descripción.');
				return false;
			}
			let params = {
				titulo: this.titulo,
				descripcion: this.descripcion
			}
			axios.post('/compras', params).then(response => {
				alert(response.data);
				this.obtenerListadoCompras();
				this.vaciarForm();
			}).catch( error => {
				console.error(error);
			});
		}
	}
}
</script>