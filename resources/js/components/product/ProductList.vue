<template>
    <div id="product-list-filter" class="row">
        <div class="col-12 col-sm-2">
            <div class="filter">
                <h4>Filtro</h4>
                <ul class="list-inline">
                    <li class="list-inline-item" v-for="filter in selectedFiltersName">
                        <span class="badge bg-info text-dark">{{ filter.name ? filter.name : filter.description }}</span>
                        <button class="btn-close" aria-label="Close" @click="removingFilter('brand', filter)" v-show="filter.id > 0"></button>
                        <button class="btn-close" aria-label="Close" @click="removingFilter('version', filter)" v-show="filter.model_id > 0"></button>
                        <button class="btn-close" aria-label="Close" @click="removingFilter('model', filter)" v-show="filter.brand_id > 0"></button>
                    </li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapseBrands" role="button" aria-expanded="false" aria-controls="collapseBrands">Marcas</a>
                        <div class="collapse" id="collapseBrands">
                            <ul class="list-unstyled">
                                <li v-for="brand in brands" class="list-filter-item">
                                    <a class="btn btn-link text-decoration-none text-dark" @click="filterPostsByBrand(brand)">
                                        {{ brand.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapseVersions" role="button" aria-expanded="false" aria-controls="collapseVersions">Versiones</a>
                        <div class="collapse" id="collapseVersions">
                            <ul class="list-unstyled">
                                <li v-for="version in versions" class="list-filter-item">
                                    <a class="btn btn-link text-decoration-none text-dark" @click="filterPostsByVersion(version)">
                                        {{ version.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapseModels" role="button" aria-expanded="false" aria-controls="collapseModels">Modelos</a>
                        <div class="collapse" id="collapseModels">
                            <ul class="list-unstyled">
                                <li v-for="model in models" class="list-filter-item">
                                    <a class="btn btn-link text-decoration-none text-dark" @click="filterPostsByModel(model)">
                                        {{ model.description }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-10">
            <div class="row">
                <div class="col">
                    <ul class="list-inline"></ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4" v-for="product in products">
                    <div class="card mb-2 product-card">
                        <a :href="productLink(product.id)">
                            <img class="card-img-top" :src="product.image" alt="">
                            <div class="card-body row">
                                <div class="col-8">
                                    <h5 class="card-title text-body">{{ product.name }}</h5>
                                    <p class="card-text text-body">{{ product.description }}</p>
                                    <p class="card-text text-body">Año: {{ product.year }}</p>
                                    <p class="card-text text-body">Versión: {{ product.version}}</p>
                                    <p class="card-text text-body">KM: {{ product.km }}</p>
                                    <p class="text-danger">{{ product.price}}</p>
                                </div>
                                <div class="col-4">
                                    <img src="/img/products/LOGO_CERTIFICADO.png" alt="Logo Certificado" class="img-fluid">
                                </div>
                            </div>
                        </a>
                    </div><!-- .card -->
                </div><!-- .col-12 -->
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "ProductList",
    data(){
        return {
            products: [],
            brands: [],
            versions: [],
            models: [],
            selectedFiltersName: [],
            filters: [
                {'brand_id': 0,
                'version_id': 0,
                'model_id': 0},
            ]
        }
    },
    mounted() {
        this.getProducts();
        this.getBrands();
        this.getVersions();
        this.getModels();
    },
    computed: {
    },
    methods: {
        productLink: function (id){
            return "/products/"+id;
        },
        getProducts: function(){
            axios({
                url: 'api/product',
                method: 'GET'
            }).then( (response) => {
                this.products = response.data;
            });
        },
        getBrands: function(){
            axios({
                url: 'api/brand',
                method: 'GET'
            }).then( (response) => {
                this.brands = response.data;
            });
        },
        getVersions: function (){
            axios.get('api/version')
                .then( (response) =>{
                   this.versions = response.data;
                });
        },
        getModels: function (){
            axios.get('api/model')
                .then( (response) =>{
                    this.models = response.data;
                });
        },
        filterPostsByBrand: function (brand){
            this.filters[0]['brand_id'] = brand.id;
            this.selectedFiltersName.push(brand);
            console.info("Haciendo el filtro con brand_id: "+brand.id);
            this.sendingFilterRequest();
        },
        filterPostsByVersion: function (version){
            this.filters[0]['version_id'] = version.id;
            this.selectedFiltersName.push(version);
            console.info("Haciendo el filtro con version_id: "+version.id);
            this.sendingFilterRequest();
        },
        filterPostsByModel: function (model){
            this.filters[0]['model_id'] = model.id;
            console.info("Haciendo el filtro con model_id: "+model.id);
            this.selectedFiltersName.push(model);
            this.sendingFilterRequest();
        },
        sendingFilterRequest: function(){
            axios({
                url: 'api/product/filter',
                method: 'POST',
                data: {
                    filters: this.filters
                }
            }).then( (response) => {
                console.info(response);
                this.products = [];
                this.products = response.data;
            });
        },
        removingFilter: function(type, filter){
            console.info("Tipo de filtro a borrar: "+type);
            console.info("Indice del elemento: "+this.selectedFiltersName.indexOf(filter));
            switch (type){
                case 'brand':
                    this.filters[0]['brand_id'] = 0;
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
                case 'version':
                    this.filters[0]['version_id'] = 0;
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
                case 'model':
                    this.filters[0]['model_id'] = 0;
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
            }
        }
    }
}
</script>

<style scoped>
.list-filter-item a{
    font-size: 14px;
    text-align: left;
}
.list-inline-item{
    position: relative;
}
.list-inline-item .btn-close{
    position: absolute;
    top: -2px;
    right: -7px;
    width: 0.2em;
    height: 0.2em;
}
</style>