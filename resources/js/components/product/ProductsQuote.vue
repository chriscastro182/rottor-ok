<template>
    <div id="products-quote-table" class="table-responsive">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cotización por Modelos</h6>
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
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>#Cotizaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products">
                        <td>{{ product.brand }}</td>
                        <td>{{ product.model }}</td>
                        <td>{{ product.year }}</td>
                        <td>{{ product.ocurrencias }}</td>
                    </tr>
                    </tbody>
                </table>
                <canvas id="products-quote-chart"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "ProductsQuote",
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
                url: '/api/customMarket/getMostBikes',
                method: 'GET',
            }).then( (response) => {
                var prods = [];
                console.info("Respuesta correcta de cotizaciones");
                console.info(response.data);
                response.data.data.forEach(function(element, id){
                    prods.push(element) ;
                });
                this.products = prods;
                this.setupChart();
            }).catch( (error) => {
                console.error(error);
            });
        },
        getLess: function(){
            axios({
                url: '/api/customMarket/getLessBikes',
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
            var ctx = document.getElementById('products-quote-chart');
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
            /*var ctx = document.getElementById('products-quote-chart');
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
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
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
                                maxTicksLimit: 6
                            },
                            maxBarThickness: 25,
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 10,
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function (value, index, values) {
                                    return value;
                                }
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
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    },
                }
            });*/
        }
    }
}
</script>

<style scoped>

</style>