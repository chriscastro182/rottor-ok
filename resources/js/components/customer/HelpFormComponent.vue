<template>
  <div id="help-form-template" class="my-3">
    <a href="#" v-b-modal.help-modal><img src="/img/BTN_AYUDA.png" alt="Ayuda"></a>
    <b-modal id="help-modal" class="modal fade" tabindex="-1" aria-labelledby="helpModalTitle" aria-hidden="true" hide-footer>
      <template #modal-header="{ close }">
        <h4>Ponte en contacto con nosotros</h4>
        <b-button size="sm" class="pull-right" variant="outline-danger" @click="close()">
          <i class="fas fa-times"></i>
        </b-button>
      </template>
      <div class="alert alert-danger" v-show="is_error">
        {{ action_message }}
      </div>
      <div class="alert alert-success" v-show="is_sent">
        {{ action_message }}
      </div>
      <div class="form">
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
          <textarea id="message" class="form-control text-secondary" name="message" placeholder="Introduce el mensaje que quieras mandar" v-model="contact.message" required></textarea>
          <div class="invalid-feedback">Introduce la información de tu moto</div>
        </div>
        <input v-show="!is_loading" class="btn btn-light mx-auto text-center" type="button" @click="sendContactData" value="Enviar">
        <div v-show="is_loading" class="spinner-border text-light text-center" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
import axios from 'axios';
export default {
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
        subject: 'Ayuda',
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
          this.is_error = false;
          this.action_message = response.data.message;
          this.$bvModal.hide('help-modal');
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

<style scoped>

</style>
