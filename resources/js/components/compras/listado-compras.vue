<template>
	<div class="card mb-4">
		<div class="card-footer" v-text="compra.titulo"></div>
		<div class="card-body">
			<p v-text="compra.descripcion"></p>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-6" v-html="'<b>Fecha de registro:</b> '+compra.fecha_registro"></div>
				<div class="col-md-6">
					<button class="btn btn-primary float-right" data-toggle="modal" :data-target="'#modalEditarCompra_'+compra.id" @click="setDataModalEditarCompra(compra)">Editar</button>
					<button class="btn btn-danger float-right mr-2" @click="eliminarCompra">Eliminar</button>
				</div>
			</div>
		</div>
		<div class="modal fade" :id="'modalEditarCompra_'+compra.id" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Editar compra</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="" @submit.prevent="editarCompra">

						<div class="modal-body">
							<div class="form-group">
								<label for="nueva_compra">Nueva compra</label>
								<input type="text" class="form-control" name="nueva_compra" v-model.trim="titulo" required>
							</div>
							<div class="form-group">
								<label for="nueva_compra">Descripción</label>
								<input type="text" class="form-control" name="nueva_compra" v-model.trim="descripcion" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-success float-right">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import {mapActions} from 'vuex'

export default {
	props: ['compra'],
	data(){
		return{
			titulo: '',
			descripcion: ''
		}
	},
	methods: {
		...mapActions({ obtenerListadoCompras: 'obtenerListadoCompras'}),
		setDataModalEditarCompra(compra){
			this.titulo = compra.titulo;
			this.descripcion = compra.descripcion;
		},
		editarCompra(){
			let params = {
				titulo: this.titulo,
				descripcion: this.descripcion
			}
			axios.put(`/compras/${this.compra.id}`, params).then(response => {
				alert(response.data);
				$(`#modalEditarCompra_${this.compra.id}`).modal('hide');
				this.obtenerListadoCompras();
			}).catch(error => {
				console.error(error);
			});
		},
		eliminarCompra(){
			if(confirm(`Está seguro de eliminar la compra ${this.compra.titulo}?`)){
				axios.delete(`/compras/${this.compra.id}`).then(response => {
					alert(response.data);
					this.obtenerListadoCompras();
				}).catch(error => {
					console.error(error);
				});
			}
		}
	}
}
</script>