<template id="contact-form">
	<div class="footer-component">
		<div v-if="!is_sent">
			<div class="alert alert-danger" v-show="is_error">
				{{ action_message }}
			</div>
			<h3 class="text-white text-uppercase text-center mb-5">cotiza aquí</h3> 
			<small class="text-white">Todos los datos con (*) son necesarios</small>
			<div class="form" >
				<div class="mb-3">
					<input class="form-control" type="text" id="name" name="name" placeholder="Nombre *" v-model="contact.name" required>
					<div class="invalid-feedback">Introduce el nombre</div>
				</div>
				<div class="mb-3">
					<input class="form-control" type="text" id="lastname" name="lastname" placeholder="Apellidos *" v-model="contact.lastname" required>
					<div class="invalid-feedback">Introduce el apellido</div>
				</div>
				<div class="mb-3">
					<input class="form-control" type="text" id="email" name="email" placeholder="Correo electrónico *" v-model="contact.email" required>
					<div class="invalid-feedback">Introduce el correo electrónico</div>
				</div>
				<div class="mb-3">
					<input class="form-control" type="text" id="phone" name="phone" placeholder="Teléfono *" v-model="contact.phone" required>
					<div class="invalid-feedback">Introduce el teléfono</div>
				</div>
				<div class="mb-3">
					<textarea id="message" class="form-control text-secondary" name="message" placeholder="Motocicleta, Marca, Modelo, Año *" v-model="contact.message" required></textarea>
					<div class="invalid-feedback">Introduce la información de tu moto</div>
				</div>
				<input v-show="!is_loading" class="btn btn-light mx-auto text-center" type="button" @click="sendContactData" value="Cotizar">
				<div v-show="is_loading" class="spinner-border text-light text-center" role="status">
					  <span class="visually-hidden">Loading...</span>
				</div>
			</div>
		</div>
		<div v-else id="contact-response">
			<h1 class="text-white text-uppercase text-center mb-5">Se ha recibido su información correctamente!</h1>
			<h2 class="text-white text-uppercase text-center mb-5">A la brevedad uno de nuestros agentes se pondrá en contacto</h2>
		</div>
	</div>
</template>
<script charset="utf-8">
import axios from "axios";

export default{
	data(){
		return {
			is_loading: false,
			is_sent: false,
			is_error: false,
			action_message: '',
			contact: {
				message: "",
				name: '',
				lastname: '',
				email: '',
				phone: '',
				subject: 'Cotización',
			},
			errors: {
				message: "",
				name: '',
				lastname: '',
				email: '',
				phone: '',
			}
		}
	},
	methods: {
		sendContactData: function(){
			this.is_loading = true;
			console.info("Se envia la data a guardar");
			axios({
				method: 'POST',
				url: '/api/messages',
				data: this.contact 
			}).then( (response) => {
				console.info("Guardando mensaje");
				console.info(response);
				if (response.data.status) {
					console.log("Se guardo correctamente la info");			
					this.is_sent = true;
				}else{
					console.info("Hubo error de validación");
					this.is_error = true;
					this.errors = response.data.message;
					this.action_message = "Faltan datos de cotización";
				}
				this.is_loading = false;
			}).catch( (error) => {
				console.error("Error en la peticion");
				console.error(error);
				this.is_loading = false;
				this.is_sent = false;
				this.is_error = true;
				this.action_message = "Hubo un error al guardar la información. Intenta más tarde";
			});
		}
	}
}
	
</script>
