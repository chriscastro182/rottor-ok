<template>
    <div id="product-appointment-form" class="form">
        <div class="mb-3">
            <label for="name">{{ customer_name }}</label>
            <input type="text" name="name" id="name" class="form-control" v-model="user.name">
        </div>
        <div class="mb-3">
            <label for="lastname">{{ customer_lastname }}</label>
            <input type="text" name="lastname" id="lastname" class="form-control" v-model="user.lastname">
        </div>
        <div class="mb-3">
            <label for="phone">{{ customer_phone }}</label>
            <input type="tel" name="phone" id="phone" class="form-control" pattern="[0-9]{10}" maxlength="10" v-model="user.phone">
        </div>
        <div class="mb-3">
            <label for="cellphone">{{ customer_cellphone }}</label>
            <input type="tel" name="cellphone" id="cellphone" class="form-control" pattern="[0-9]{10}" maxlength="10" v-model="user.cellphone">
        </div>
        <div class="mb-3">
            <label for="lastname">{{ customer_email }}</label>
            <input type="email" name="email" id="email" class="form-control" v-model="user.email">
        </div>
        <div class="mb-3">
            <label for="appointment_date">{{ appointment_date }}</label>
            <input type="date" name="day" id="appointment_date" class="form-control" v-model="appointment.day" v-bind:min="fechaMinima">
            
        </div>
        <div class="mb-3">
            <label for="appointment_hour">{{ appointment_hour }}</label>
            <input type="time" name="hour" id="appointment_hour" class="form-control" v-model="appointment.hour">
        </div>
        <div class="mx-auto w-50">
            <div class="form-check my-3">
                <input type="checkbox" name="terms_check" id="terms-check" class="form-check-input" v-model="terms_check">
                <label for="terms-check" class="form-check-label"><a class="" :href="privacy_route">{{ accept_terms }}</a></label>
            </div>
            <div class="form-check my-3">
                <input type="checkbox" name="privacy_check" id="privacy-check" class="form-check-input" v-model="privacy_check">
                <label for="privacy-check" class="form-check-label"><a class="" :href="privacy_route">{{ accept_privacy }}</a></label>
            </div>
        </div>
        <div class="alert alert-success" v-show="is_appointed">
            {{ action_message }}
        </div>
        <div class="text-center mx-auto w-50">
            <input type="submit" :value="appointment_submit" class="btn btn-warning btn-lg text-center mx-auto" @click="makeAppointment" :disabled="!(user.name != '') && (user.lastname != '') && (user.phone != '') && (user.cellphone != '') && (user.email != '') && (appointment.day != '') && (appointment.hour != '')">
            <p v-if="!(user.name != '') && (user.lastname != '') && (user.phone != '') && (user.cellphone != '') && (user.email != '') && (appointment.day != '') && (appointment.hour != '')">Favor de llenar todos los datos </p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "ProductAppointmentComponent",
    props: ['product_id', 'customer_name', 'customer_lastname', 'customer_phone', 'customer_cellphone', 'customer_email', 'appointment_date', 'appointment_hour', 'appointment_submit', 'accept_terms', 'accept_privacy', 'privacy_route'],
    data(){
        return {
            user: {
                name: '',
                lastname: '',
                phone: '',
                cellphone: '',
                email: '',
            },
            appointment: {
                day: '',
                hour: ''
            },
            terms_check: false,
            privacy_check: false,
            is_appointed: false,
            action_message: ''
        }
    },
    methods: {
        makeAppointment: function () {
            axios({
                method: 'POST',
                url: '/api/appointment/product',
                data: {
                    user: this.user,
                    appointment: this.appointment,
                    terms_check: this.terms_check,
                    privacy_check: this.privacy_check,
                    product_id: this.product_id
                }
            }).then( (response) => {
                console.info("Data de respuesta");
                console.info(response);
                if (response.data.status){
                    this.action_message = response.data.message;
                    this.is_appointed = true;
                }else{
                    alert(response.message);
                }
            });
        },
    },
    computed: {
    fechaMinima() {
      const fecha = new Date();
      fecha.setDate(fecha.getDate() + 1); // suma un día a la fecha actual
      return fecha.toISOString().split('T')[0]; // devuelve una cadena de fecha formateada
    }
  }
}
</script>

<style scoped>

</style>
