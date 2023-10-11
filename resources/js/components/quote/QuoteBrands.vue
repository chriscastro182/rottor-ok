<template>
    <div id="quote-brands" class="table-responsive">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cotización de Marcas por Clientes</h6>
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
                <table class="table table-bordered" id="quote-brands-table">
                    <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Año</th>
                        <th>#Cotizaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="quote in quotes">
                        <td>{{ quote.name }}</td>
                        <td>{{ quote.year }}</td>
                        <td>{{ quote.ocurrencias }}</td>
                    </tr>
                    </tbody>
                </table>
                <canvas id="quote-brands-chart"></canvas>
            </div><!-- .card-body -->
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "QuoteBrands",
    data(){
        return {
            quotes: [],
            is_most: false,
            brands: [],
            ocurrences: [],
        }
    },
    mounted() {
        this.getMost();
    },
    methods: {
        getData: function(){
            var brands = [];
            var ocurrences = [];
            this.quotes.forEach(function(element, index){
                brands.push(element.name);
                ocurrences.push(element.ocurrencias);
            });
            this.brands = brands;
            this.ocurrences = ocurrences;
        },
        getMost: function(){
            axios({
                url: '/api/quotation/mostBrands',
                method: 'GET'
            }).then( (response) => {
                this.quotes = response.data.data;
                this.setupChart();
            }).catch( (error) => {
                console.error(error);
            });
        },
        getLess: function(){
            axios({
                url: '/api/quotation/lessBrands',
                method: 'GET'
            }).then( (response) => {
                this.quotes = response.data.data;
                this.setupChart();
            }).catch( (error) => {
                console.error(error);
            });
        },
        setupChart: function() {
            this.getData();
            var ocurrences = this.ocurrences;
            var models = this.brands;
            console.info("Marcas");
            console.info(this.brands);
            console.info("Ocurrencias");
            console.info(this.ocurrences);
            var ctx = document.getElementById('quote-brands-chart');
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
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'Marca'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 1
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
