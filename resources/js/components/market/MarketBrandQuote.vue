<template>
    <div id="market-brand-quote" class="table-responsive">
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
            </div><!-- .card-body -->
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "MarketBrandQuote",
    data(){
        return {
            markets: [],
            is_most: false,
            brands: [],
            ocurrences: [],
        }
    },
    mounted() {
        this.getMost();
    },
    methods: {
        getMost: function(){
            axios({
                url: '/api/market/mostBrands',
                method: 'GET'
            }).then( (response) => {
                this.brands = response.data.data;
            }).catch( (error) => {
                console.error(error);
            });
        },
        getLess: function(){
            axios({
                url: '/api/market/lessBrands',
                method: 'GET'
            }).then( (response) => {
                this.brands = response.data.data;
            }).catch( (error) => {
                console.error(error);
            });
        }
    }
}
</script>

<style scoped>

</style>
