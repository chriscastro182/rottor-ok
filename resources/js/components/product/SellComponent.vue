<template>
    <div id="sell-component">
        <div class="bg-white py-2 px-3 text-center">
            <div id="btn-pagination" class="btn-group mx-auto" role="group">
                <button type="button" @click="changeState('year')" class="btn btn-light py-2 px-4 mx-2" id="year_state"></button>
                <button type="button" @click="changeState('brand')" class="btn btn-light py-2 px-4 mx-2" id="brand_state"></button>
                <button type="button" @click="changeState('model')" class="btn btn-light py-2 px-4 mx-2" id="model_state"></button>
                <button type="button" @click="changeState('km')" class="btn btn-light py-2 px-4 mx-2" id="km_state"></button>
                <button type="button" @click="changeState('full')" class="btn btn-light py-2 px-4 mx-2" id="final-state"></button>
            </div>
        </div>
        <div class="title-fragment py-2 px-3 text-white">
            <div class="col-12">
                <h1 class="text-center">{{ title.join(" - ") }}</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mx-auto position-relative h-100">
                        <div id="year-selection" v-show="current_state == 'year'">
                            <div class="section-title my-3">
                                <h2 class="text-center">Selecciona el año</h2>
                            </div>
                            <div class="section-content">
                                <div class="row row-cols-3">
                                    <div class="col" v-for="year in years">
                                        <div class="card mb-2">
                                            <div class="card-body text-center pe-auto clickable-card h5" @click="selectYear(year)">
                                                <span class="clickable">{{ year }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="brand-selection" v-show="current_state =='brand'">
                            <div class="section-title my-3 form">
                                <h2 class="text-center">Busqueda por marca</h2>
                                <input type="text" v-model="searchBrand" placeholder="Búscar" class="form-control">
                            </div>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-12" >
                                        <ul class="list-group">
                                            <li style="cursor: pointer;" class="list-group-item d-flex align-items-center clickable h5" v-for="brand in filteredBrands" @click="selectBrand(brand)">
                                                <img style="max-width: 175px; max-height: 70px;" :src="brand.image" class="img-fluid">
                                                <span class="clickable">{{ brand.name }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="section-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('brand')">Regresar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="model-selection" v-show="current_state =='model'">
                            <div class="section-title my-3 form">
                                <h2 class="text-center">Busqueda por modelo</h2>
                                <input type="text" v-model="searchModel" placeholder="Búscar" class="form-control">
                            </div>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-12" >
                                        <ul class="list-group">
                                            <li class="list-group-item clickable-li h5" v-for="model in filteredModels" @click="selectModel(model)">
                                                <span class="clickable">{{ model.description }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                            <div class="section-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('model')">Regresar</button>
                                    </div>
                                </div>
                            </div><!-- .section-footer -->
                        </div>
                        <div id="version-selection" v-show="current_state =='version'">
                            <div class="section-title my-3 form">
                                <h2 class="text-center">Busqueda por versión</h2>
                                <input type="text" v-model="searchVersion" placeholder="Búscar" class="form-control">
                            </div>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-12" >
                                        <ul class="list-group">
                                            <li class="list-group-item clickable-li h5" v-for="version in filteredVersions" @click="selectVersion(version)">
                                                <span class="clickable">{{ version.name }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                            <div class="section-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('version')">Regresar</button>
                                    </div>
                                </div>
                            </div><!-- .section-footer -->
                        </div><!-- #version-selection -->
                        <div id="km-selection" v-show="current_state =='km'">
                            <div class="section-title my-3">
                                <h2 class="text-center">Selecciona el Kilometraje</h2>
                            </div><!-- .section-title -->
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4" v-for="km in kms" v-if="km.id != 8 && km.id != 11">
                                        <div class="card mb-2">
                                            <div class="card-body text-center clickable-card h5" @click="selectKm(km)">
                                                <span class="clickable">{{ km.min_km }}KM - {{ km.max_km }}KM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                            <div class="section-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('km')">Regresar</button>
                                    </div>
                                </div>
                            </div><!-- .section-footer -->
                        </div>
                        <div id="color-selection" v-show="current_state =='color'"></div>
                        <div id="full-cotization" v-show="current_state =='full'">
                            <div class="section-title my-3">
                                <h2 class="text-center">Esta es tu cotización</h2>
                            </div>
                            <div class="section-content">
                                <table class="table table-striped">
                                    <thead>
                                    <tr v-if="is_cashable">
                                        <th>Pago de Contado</th>
                                        <th>Pago por Cambio</th>
                                        <th>Pago por consignacion</th>
                                    </tr>
                                    <tr v-else>
                                        <th>Pago por consignacion</th>
                                    </tr>
                                    </thead>
                                    <tbody v-if="is_cashable">
                                        <tr v-for="coti in cotization">
                                            <td>${{ new Intl.NumberFormat().format(coti.full_payment) }}</td>
                                            <td>${{ new Intl.NumberFormat().format(coti.exchange_payment) }}</td>
                                            <td>${{ new Intl.NumberFormat().format(coti.allocation_payment) }}</td>
                                        </tr>
                                        <tr >
                                            <td colspan="3">
                                                <div class="text-center">
                                                    <h3 class="text-center">Agenda tu cita de Inspección</h3>
                                                </div>
                                                <div class="meetings-iframe-container" :data-src="'https://meetings.hubspot.com/rottor?embed=true&firstname='+user.name+'&lastname='+user.lastname+'&email='+ user.email"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr v-for="coti in cotization">
                                            <td colspan="3">${{ new Intl.NumberFormat().format(coti.allocation_payment) }}</td>
                                        </tr>
                                        <tr >
                                            <td colspan="3">
                                                <div class="text-center">
                                                    <h3 class="text-center">Agenda tu cita de Inspección</h3>
                                                </div>
                                                <div class="meetings-iframe-container" :data-src="'https://meetings.hubspot.com/rottor?embed=true&firstname='+user.name+'&lastname='+user.lastname+'&email='+ user.email"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- .section-content -->
                            <div class="section-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('full')">Regresar</button>
                                    </div>
                                </div>
                            </div><!-- .section-footer -->
                        </div><!-- #full-cotization -->
                        <div id="cotization-selection" v-show="current_state =='appointment'">
                            <div class="section-title my-3">
                                <h2 class="text-center">Déjanos tus datos para ver la cotización</h2>
                            </div>
                            <div class="section-content my-3">
                                <div class="alert alert-success" v-show="is_appointed">
                                    {{ action_message }}
                                </div>
                                <div class="alert alert-success" v-show="validation_fail">
                                    {{ action_message }}
                                </div>
                                
                                <div class="form">
                                    <div class="form-group">
                                        <label class="form-label" for="name"></label>
                                        <input id="name" class="form-control" type="text" name="name" v-model="user.name" placeholder="EJ. Juan" autocomplete="first-name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name"></label>
                                        <input id="lastname" class="form-control" type="text" name="lastname" v-model="user.lastname" placeholder="EJ. Perez" autocomplete="last-name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email"></label>
                                        <input id="email" class="form-control" type="email" name="email" v-model="user.email" placeholder="EJ. ejemplo@mail.com" autocomplete="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="cellphone"></label>
                                        <input id="cellphone" class="form-control" type="cellphone" name="cellphone" v-model="user.cellphone" placeholder="EJ. 55 5555 5555" autocomplete="cellphone">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="form-label" for="phone"></label>
                                        <input id="date" class="form-control" type="date" name="date" v-model="appointment.day" placeholder="EJ. 00/00/0000" autocomplete="date" v-bind:min="fechaMinima">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="phone"></label>
                                        <input id="time" class="form-control" type="time" name="time" v-model="appointment.hour" placeholder="EJ. 00:00" autocomplete="time">
                                    </div> -->
                                    <small class="text-secondary my-2">Al continuar, acepto los Términos y Condiciones, Política de Privacidad de ROTTOR</small>
                                    <br>
                                    <button class="btn btn-secondary" @click="getAppointment()">Ver Cotización</button>

                                </div>
                            </div><!-- .section-content -->
                            <div class="section-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('km')">Regresar</button>
                                    </div>
                                </div>
                            </div><!-- .section-footer -->
                        </div><!-- cotization-selection -->
                        <div id="custom-form" v-show="current_state =='custom'" class="mb-2 mb-sm-4">
                            <div class="card my-4">
                                <div class="alert alert-warning" v-show="budget_fail">
                                    {{ action_message }}
                                </div>
                                <div class="card-header">
                                    <h3 class="text-body my-2 my-sm-4">Dejanos los datos de tu moto para que a la brevedad te enviemos una cotización</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form mb-2 mb-sm-4">
                                        <div class="mb-3">
                                            <label for="custom-year" class="label-control">Año:</label>
                                            <input type="text" name="custom_year" id="custom-year" class="form-control" v-model="customer_custom.year" placeholder="Ej. 2020">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-brand" class="label-control">Marca:</label>
                                            <input type="text" name="custom_brand" id="custom-brand" class="form-control" v-model="customer_custom.brand" placeholder="Ej. BMW">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-model" class="label-control">Modelo:</label>
                                            <input type="text" name="custom_model" id="custom-model" class="form-control" v-model="customer_custom.model" placeholder="Ej. 1250 GS Adventure">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-km" class="label-control">Kilometraje:</label>
                                            <input type="text" name="custom_km" id="custom-km" class="form-control" v-model="customer_custom.km" placeholder="Ej. 20,000 KM">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-cc" class="label-control">Cilindrada:</label>
                                            <input type="text" name="custom_cc" id="custom-cc" class="form-control" v-model="customer_custom.cc" placeholder="Ej. 650cc">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-name" class="label-control">Nombre(s):</label>
                                            <input id="custom-name" class="form-control" type="text" name="name" v-model="user.name" placeholder="Ej. Juan Antonio">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-lastname" class="label-control">Apellido(s):</label>
                                            <input id="custom-lastname" class="form-control" type="text" name="lastname" v-model="user.lastname" placeholder="EJ. Perez">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-email" class="label-control">Correo electrónico:</label>
                                            <input id="custom-email" class="form-control" type="email" name="email" v-model="user.email" placeholder="EJ. ejemplo@mail.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="custom-phone" class="label-control">Teléfono:</label>
                                            <input id="custom-phone" class="form-control" type="cellphone" name="cellphone" v-model="user.phone" placeholder="EJ. 55 5555 5555" pattern="[0-9]{10}" maxlength="10">
                                        </div>
                                        <div class="alert alert-success text-uppercase h4" v-show="is_custom_send">
                                            {{ action_message }}
                                        </div>
                                    </div><!-- .form -->
                                </div><!-- .card-body -->
                                <div class="card-footer">
                                    <button class="btn btn-dark btn-lg text-white" @click="makeCotization" :disabled="!(user.cellphone != '' && user.email != '' && user.lastname != '' && user.name != '' && customer_custom.cc != '' && customer_custom.km != '' && customer_custom.model != '' && customer_custom.brand != '' && customer_custom.year != '')">Cotizar</button>
                                    <p v-if="!(user.cellphone != '' && user.email != '' && user.lastname != '' && user.name != '' && customer_custom.cc != '' && customer_custom.km != '' && customer_custom.model != '' && customer_custom.brand != '' && customer_custom.year != '')">Favor de llenar todos los datos</p>
                                </div><!-- .card-footer -->
                            </div><!-- .card -->
                            <div class="section-footer my-4">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-secondary" @click="returnState('custom')">Regresar</button>
                                    </div>
                                </div>
                            </div><!-- .section-footer -->
                        </div><!-- #custom-form -->
                        <div id="more-button" class="mx-auto my-4 text-center">
                            <a href="#" @click="getHelp" class="btn btn-warning btn-lg h1" v-html="help"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script charset="utf-8">
import axios from "axios";

export default{
    data(){
        return {
            title: [],
            is_appointed: false,
            validation_fail: false,
            is_custom_send: false,
            action_message: '',
            searchBrand: '',
            searchModel: '',
            searchVersion: '',
            is_loading: false,
            help: '&iquest;No encuentras tu moto?',
            years: [],
            brands: [],
            models: [],
            versions: [],
            kms: [],
            is_cashable: false,
            budget_fail: false,
            current_state: 'year',
            appointment: {
                day: '',
                hour: '',
            },
            customer_selection: {
                year: '',
                brand: '',
                model: '',
                version: '',
                km: '',
                color: ''
            },
            customer_selection2: {
                year: '',
                brand: '',
                model: '',
                version: '',
                km: '',
                color: ''
            },
            customer_custom: {
                year: '',
                brand: '',
                model: '',
                version: '',
                km: '',
                cc: '',
            },
            user: {
                name: '',
                lastname: '',
                email: '',
                cellphone: ''
            },
            cotization: {}
        }
    },
    created(){
        for (var i = 2015; i <= (new Date().getFullYear()); i++) {
            this.years.push(i);
        }
        this.title[0] = 'Vende tu moto';
        //console.log(this.years)
    },
    computed: {
        fechaMinima() {
        const fecha = new Date();
        fecha.setDate(fecha.getDate() + 1); // suma un día a la fecha actual
        return fecha.toISOString().split('T')[0]; // devuelve una cadena de fecha formateada
        },
        filteredBrands(){
            return this.brands.filter(marca => {
                var result = '';
                result = marca.name.indexOf(this.searchBrand.toUpperCase()) > -1;
                return result;
            });
        },
        filteredModels(){
            return this.models.filter(modelo => {
                var result = '';
                if (modelo.description)
                    result = modelo.description.indexOf(this.searchModel) > -1;
                return result;
            });
        },
        filteredVersions(){
            return this.versions.filter(version => {
                var result = '';
                if (version.name)
                    result = version.name.indexOf(this.searchVersion) > -1;
                return result;
            });
        }
    },
    methods: {
        selectYear: function(year){
            this.customer_selection.year = year;
            this.customer_selection2.year = year;
            this.current_state = 'brand';
            this.title[0] = this.customer_selection.year.toString();
            $('#year_state').addClass('state-bg');
            this.getBrands();
        },
        selectBrand: function(brand){
            console.log('imprimimos el brand');
            console.log(brand);
            this.customer_selection.brand = brand.id;
            this.customer_selection2.brand = brand.name;
            this.current_state = 'model';
            this.title[1] = brand.name;
            $('#brand_state').addClass('state-bg');
            this.getModels();
        },
        selectModel: function(model){
            console.log('imprimimos el model');
            console.log(model);
            this.customer_selection.model = model.id;
            this.customer_selection2.model = model.description;
            this.getVersions();
            this.title[2] = model.description;
            $('#model_state').addClass('state-bg');
            this.current_state = 'version';
        },
        selectVersion: function (version){
            console.log('imprimimos el version');
            console.log(version);
            this.customer_selection.version = version.id;
            this.customer_selection2.version = version.name;
            this.getKms();
            this.title[3] = version.name;
            this.current_state = 'km';
        },
        selectKm: function(km){
            console.log('imprimimos el km');
            console.log(km);

            this.customer_selection.km = km.id;
            //convertimos el min y max a texto y lo metemos en una variable
            this.customer_selection2.km = km.min_km+' - '+km.max_km;
            this.title[4] = km.min_km+' - '+km.max_km;
            $('#km_state').addClass('state-bg');
            this.getCotization()
            //this.current_state = 'full';
            //this.current_state = 'appointment';
        },
        getBrands: function(){
            axios({
                method : 'GET',
                url: '/api/brand/'+this.customer_selection.year,

            }).then( (response) => {
                this.brands = response.data;
                console.log(response);
            });
        },
        getModels: function(){
            axios({
                method : 'GET',
                url: '/api/model/year/'+this.customer_selection.year+'/brand/'+this.customer_selection.brand,
            }).then( (response) => {
                this.models = response.data;
                console.log(response)
            });
        },
        getVersions: function (){
            axios({
                method : 'GET',
                url: '/api/model/'+this.customer_selection.model+'/version/'+this.customer_selection.year,
            }).then( (response) => {
                this.versions = response.data;
                console.log(response)
            });
        },
        getKms: function(){
            axios({
                method : 'GET',
                url: '/api/km',
            }).then( (response) => {
                this.kms = response.data;
            });
        },
        gotToAppointment: function(){
            this.current_state = 'appointment';
        },
        getCotization: function(){
            console.log('Se busca obtener cotización para la moto seleccionada')
            console.log(this.customer_selection);
            axios({
                method : 'POST',
                url: '/api/market/full',
                data: this.customer_selection
            }).then( (response) => {
                console.info(response.data);
                this.cotization = response.data;
                if (this.checkCotization(this.cotization))
                    this.current_state = 'appointment';
                else
                    this.current_state = 'custom';
            });
        },
        getAppointment: function(){
            console.info("Se busca obtener una cita para revisar cotización generada");
            axios({
                method : 'POST',
                url: '/api/appointment',
                data: {
                    user: this.user,
                    market: this.cotization[0],
                    customer: this.customer_selection,
                    appointment: this.appointment,
                    customer2: this.customer_selection2,
                }
            }).then( (response) => {
                console.info(response.data);
                if (response.data.state){
                    //this.action_message = response.data.message;
                    
                    //this.is_appointed = true;
                    this.buildScriptSource();
                    this.current_state = 'full';
                }else{
                    this.is_appointed = false;
                    this.action_message = response.data.message;
                }
            });
        },
        buildScriptSource(){
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://static.hsappstatic.net/MeetingsEmbed/ex/MeetingsEmbedCode.js';

            // Obtener el div de Meetings Embed Container
            const containerDiv = this.$el.querySelector('.meetings-iframe-container');

            // Insertar el script después del div
            containerDiv.parentNode.insertBefore(script, containerDiv.nextSibling);
        },
        changeState: function(state){
            this.current_state = state;
        },
        getHelp: function(){
            this.current_state = 'custom';
            $('#more-button').hide(true);
        },
        checkCotization: function(cotizations){
            console.info("Checando la cotizacion");
            
            if (cotizations.length>0) {
                var cotizationData = cotizations[0];

                this.is_cashable = cotizationData.is_cashiable;
                
                if (cotizations.length > 1){
                    return true;
                } else {
                    console.info(cotizationData);

                    if (cotizationData.full_payment == 0 && cotizationData.exchange_payment == 0 && cotizationData.allocation_payment == 0){
                        console.info("Los valores son 0");
                        return false;
                    }else{
                        console.info("Hay valores validos");
                        return true;
                    }
                }
            } else{
                this.action_message = 'No tenemos cotización para tu moto por el momento';
                this.budget_fail = true;
                console.log( this.action_message);
                //this.getHelp();
                return false;
            }
        },
        makeCotization: function(){
            console.log('Imprimimos los datos');
            console.log(this.customer_custom)
            console.log(this.user);
            console.info("Se busca realizar la cotizacion");
            console.info(this.customer_custom);
            console.info(this.user);
            axios({
                method: 'POST',
                url: '/api/customMarket',
                data: {
                    user: this.user,
                    custom: this.customer_custom
                }
            }).then( (response) => {
                console.info(response.data);
                this.is_custom_send = true;
                if (response.data.state){
                    this.action_message = response.data.message;
                }
            });
        },
        returnState: function (state){
            switch (state){
                case 'brand':
                    this.current_state = 'year';
                    break;
                case 'model':
                    this.current_state = 'brand';
                    break;
                case 'version':
                    this.current_state = 'model';
                    break;
                case 'km':
                    this.current_state = 'version';
                    break;
                case 'full':
                    this.current_state = 'km';
                    break;
                case 'appointment':
                    this.current_state = 'full';
                    break;
                case 'custom':
                    this.current_state = 'year';
                    break;
            }
        },
    }
}
</script>
<style>
#brand-selection .section-content,
#model-selection .section-content{
    height: 500px;
    overflow-y: scroll;
}
#more-button{
    z-index: 20;
}
</style>
