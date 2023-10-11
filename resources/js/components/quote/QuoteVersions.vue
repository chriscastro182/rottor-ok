<template>
    <div id="quote-versions" class="table-responsive">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cotización de Versiones por Clientes</h6>
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
                <table class="table table-bordered" id="quote-versions-table">
                    <thead>
                    <tr>
                        <th>Versión</th>
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
                <canvas id="quote-versions-chart"></canvas>
            </div><!-- .card-body -->
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "QuoteVersions",
    data(){
        return {
            quotes: [],
            is_most: false,
            versions: [],
            ocurrences: [],
        }
    },
    mounted() {
        this.getMost();
    },
    methods: {
        getData: function(){
            var versions = [];
            var ocurrences = [];
            this.quotes.forEach(function(element, index){
                versions.push(element.name);
                ocurrences.push(element.ocurrencias);
            });
            this.versions = versions;
            this.ocurrences = ocurrences;
        },
        getMost: function(){
            axios({
                url: '/api/quotation/mostVersions',
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
                url: '/api/quotation/lessVersions',
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
            var models = this.versions;
            console.info("Versiones");
            console.info(this.versions);
            console.info("Ocurrencias");
            console.info(this.ocurrences);
            var ctx = document.getElementById('quote-versions-chart');
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
                                unit: 'Versión'
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
