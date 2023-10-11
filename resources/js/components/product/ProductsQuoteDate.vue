<template>
    <div id="products-quotedate-table" class="table-responsive">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cotización por Fecha</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                         aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Opciones</div>
                        <a class="dropdown-item" @click="getMost">Más Cotizan</a>
                        <a class="dropdown-item" @click="getLess">Menos Cotizan</a>
                    </div>
                </div>
            </div><!-- .card-header -->
            <div class="card-body">
                <table class="table table-bordered" id="products-quote">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>#Cotizaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products">
                        <td>{{ product.fecha }}</td>
                        <td>{{ product.hora }}</td>
                        <td>{{ product.ocurrencias }}</td>
                    </tr>
                    </tbody>
                </table>
                <canvas id="products-quotedate-chart"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "ProductsQuoteDate",
    data() {
        return {
            products: [],
            is_most: false,
            models: [],
            ocurrences: [],
        }
    },
    mounted() {
        this.getMost();
    },
    methods: {
        getData: function(){
            var models = [];
            var ocurrences = [];
            this.products.forEach(function(element, index){
                models.push(element.model);
                ocurrences.push(element.ocurrencias);
            });
            this.models = models;
            this.ocurrences = ocurrences;
        },
        getMost: function(){
            axios({
                url: '/api/customMarket/getMostDate',
                method: 'GET',
            }).then( (response) => {
                var prods = [];
                console.info("Respuesta correcta de cotizaciones");
                console.info(response.data);
                response.data.data.forEach(function(element, id){
                    prods.push(element) ;
                });
                this.products = prods
                this.setupChart();
            }).catch( (error) => {
                console.error(error);
            });
        },
        getLess: function(){
            axios({
                url: '/api/customMarket/getLessDate',
                method: 'GET',
            }).then( (response) => {
                var prods = [];
                console.info("Respuesta correcta de cotizaciones");
                console.info(response.data);
                response.data.data.forEach(function(element, id){
                    prods.push(element) ;
                });
                this.products = prods
                this.setupChart();
            }).catch( (error) => {
                console.error(error);
            });
        },
        setupChart: function(){
            this.getData();
            var ocurrences = this.ocurrences;
            var models = this.models;
            console.info("Modelos");
            console.info(this.models);
            console.info("Ocurrencias");
            console.info(this.ocurrences);
            var ctx = document.getElementById('products-quotedate-chart');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: models,
                    datasets: [{
                        label: "Cotizaciones",
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        data: ocurrences,
                    }],
                },
                options:{
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'Modelo'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit:1
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 10,
                                padding: 10,
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                }
            }).update();
        }
    }
}
</script>

<style scoped>

</style>