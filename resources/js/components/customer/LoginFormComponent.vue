<template id="login-template">
    <div class="login-form">
        <b-dropdown split dropleft class="p-0" ref="dropdown">
            <template #button-content>
                <i class="fas fa-user-circle"></i>
            </template>
            <b-tabs content-class="mt-3" v-if="!is_loggedin">
                <b-tab title="Acceder" active>
                    <b-card-text class="my-0 my-sm-3">
                        <div class="alert alert-danger" v-show="is_error">
                            {{ action_message }}
                        </div>
                        <div class="alert alert-success" v-show="is_loggedin">
                            {{ action_message }}
                        </div>
                        <div class="form px-2 px-sm-4" >
                            <div class="mb-3">
                                <input id="email" class="form-control" type="text" name="email" v-model="customer.email" placeholder="Correo electrónico">
                            </div>
                            <div class="mb-3">
                                <input id="password" class="form-control" type="password" name="password" v-model="customer.password" placeholder="Contraseña">
                            </div>
                            <div class="text-center">
                                <input v-show="!is_loading" class="btn btn-light mx-auto text-center" type="button" @click="loginCustomer" value="Acceder">
                            </div>
                            <div v-show="is_loading" class="spinner-border text-light text-center" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </b-card-text>
                </b-tab>
                <b-tab title="Registrarse">
                    <b-card-text>
                        <div class="alert alert-danger" v-show="is_error">
                            {{ action_message }}
                        </div>
                        <div class="alert alert-success" v-show="is_loggedin">
                            {{ action_message }}
                        </div>
                        <div class="form px-2 px-sm-4" >
                            <div class="mb-3">
                                <input id="name" class="form-control" type="text" name="name" v-model="customer.name" placeholder="Nombre(s)">
                            </div>
                            <div class="mb-3">
                                <input id="lastname" class="form-control" type="text" name="lastname" v-model="customer.lastname" placeholder="Apellido(s)">
                            </div>
                            <div class="mb-3">
                                <input id="email" class="form-control" type="text" name="email" v-model="customer.email" placeholder="Correo electrónico">
                            </div>
                            <div class="mb-3">
                                <input id="password" class="form-control" type="password" name="password" v-model="customer.password" placeholder="Contraseña">
                            </div>
                            <div class="mb-3">
                                <input id="confirm-password" class="form-control" type="password" name="confirm-password" v-model="customer.confirm" placeholder="Confirma la contraseña">
                            </div>
                            <div class="text-center">
                                <input v-show="!is_loading" class="btn btn-light mx-auto text-center" type="button" @click="registerCustomer" value="Registrar">
                            </div>
                            <div v-show="is_loading" class="spinner-border text-light text-center" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </b-card-text>
                </b-tab>
            </b-tabs>
            <b-dropdown-form v-else>
                <b-button variant="primary" @click="logout">Salir de la cuenta</b-button>
            </b-dropdown-form>
        </b-dropdown>
        <b-modal id="bv-modal-success-login">
            <div class="d-block text-center">
                <h3>Accedio correctamente</h3>
            </div>
        </b-modal>
    </div>
</template>
<script charset="utf-8">
import axios from "axios";

export default{
	data(){
		return {
			token: '',
			is_loading: false,
			is_sent: false,
			is_error: false,
			is_loggedin: false,
            is_show: false,
			action_message: '',
			customer: {
                name: '',
                lastname: '',
				email: '',
				password: '',
                confirm: '',
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
	created(){
		console.info("Entrando al montado del componente");
		if (this.$cookies.get('rottor_login')) {
			this.token = this.$cookies.get('rottor_login');	
			this.is_loggedin = true;
			console.info(this.token);
		}
	},
	methods: {
        showModal: function(){
            this.is_show = true;
        },
        closeModal: function(){
            this.is_show = false;
        },
        logout: function(){
            this.$cookies.remove('rottor_login');
            this.is_loggedin = false;
        },
        registerCustomer: function(){
            this.is_loading = true;
            console.info("Se envia la data a registrar");
            if (this.customer.confirm !== this.customer.password){
                this.action_message = "Las confirmación de contraseña no coincide";
                this.is_error = true;
                this.errors = "La confirmación de contraseña no coincide";
                this.is_loggedin = false;
                this.is_loading = false;
            }else{
                axios({
                    method: 'POST',
                    url: '/api/customers',
                    data: this.customer
                }).then( (response) => {
                    console.info('Mensaje de registro');
                    console.info(response);
                    if (response.data.status) {
                        console.log("Se registro al cliente correctamente");
                        this.is_loading = false;
                        this.is_error = false;
                        this.is_loggedin = true;
                        this.action_message = response.data.message;
                        //this.$bvModal.hide('login-modal');
                        this.$cookies.set('rottor_login', response.data.token);
                    }else{
                        console.info("Hubo error de validación");
                        this.is_error = true;
                        this.errors = response.data.message;
                        this.action_message = response.data.message;
                        this.is_loggedin = false;
                    }
                    this.is_loading = false;
                    this.$refs.dropdown.hide(true)
                }).catch( (error) => {
                    console.error("Error en la peticion");
                    console.error(error);
                    this.is_loading = false;
                    this.is_sent = false;
                    this.is_error = true;
                    this.action_message = "Hubo un error al registrar la información. Intenta más tarde";
                });
            }
        },
		loginCustomer: function(){
			this.is_loading = true;
            console.info("Se busca logear al usuario");
			console.info("Se envia la data a guardar");
			axios({
				method: 'POST',
				url: '/api/customers/login',
				data: this.customer 
			}).then( (response) => {
				console.info("Guardando mensaje");
				console.info(response);
				if (response.data.status) {
					console.log("Se accedio al cliente correctamente");			
					this.is_loading = false;
					this.is_error = false;
					this.is_loggedin = true;
					this.action_message = response.data.message;
					//this.$bvModal.hide('login-modal');
					this.$cookies.set('rottor_login', response.data.token);
                    this.$refs.dropdown.hide(true);
                    console.log("Se busca mostrar el mensaje de acceso correcto");
                    this.$bvModal.show('bv-modal-success-login');
				}else{
					console.info("Hubo error de validación");
					this.is_error = true;
					this.errors = response.data.message;
					this.action_message = response.data.message;
					this.is_loggedin = false;
				}
				this.is_loading = false;
			}).catch( (error) => {
				console.error("Error en la peticion");
				console.error(error);
				this.is_loading = false;
				this.is_sent = false;
				this.is_error = true;
				this.action_message = "Hubo un error al acceder. Intenta más tarde";
			});
		}
	}
}
</script>
<style>
@media screen and (min-width : 320px) and (max-width : 480px) {
    .login-form{
        margin: 0 auto;
    }
}
@media screen and (min-width : 480px){
    .login-form{
    }
}
.form{
    max-width: 550px;
    min-width: 300px;
    width: 100%;
}
.navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .show > .nav-link{
    color: #000;
}
.navbar-dark .navbar-nav .nav-link,
.navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover{
    color: #727272;
}
</style>
