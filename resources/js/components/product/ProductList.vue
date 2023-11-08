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
                        <button class="btn-close" aria-label="Close" @click="removingFilter('km', filter)" v-show="filter.km_id  >= 0"></button>
                        <button class="btn-close" aria-label="Close" @click="removingFilter('price', filter)" v-show="filter.price_id  >= 0"></button>
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
                    <li class="list-group-item">
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapseYears" role="button" aria-expanded="false" aria-controls="collapseYears">Años</a>
                        <div class="collapse" id="collapseYears">
                            <ul class="list-unstyled">
                                <li v-for="year in years" class="list-filter-item">
                                    <a class="btn btn-link text-decoration-none text-dark" @click="filterPostsByYear(year)">
                                        {{ year }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapseKms" role="button" aria-expanded="false" aria-controls="collapseKms">Kilómetros</a>
                        <div class="collapse" id="collapseKms">
                            <label for="">Rango</label>
                            <ul class="list-unstyled">
                                <li v-for="index in 6" class="list-filter-item">
                                    <a class="btn btn-link text-decoration-none text-dark" @click="filterPostsByKM(index-1)">
                                        {{ minKmRanges[index-1] }} - {{ maxKmRanges[index-1] }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-light" data-bs-toggle="collapse" href="#collapsePrice" role="button" aria-expanded="false" aria-controls="collapsePrice">Precios</a>
                        <div class="collapse" id="collapsePrice">
                            <label for="">Rango</label>
                            <ul class="list-unstyled">
                                <li v-for="index in 6" class="list-filter-item">
                                    <a class="btn btn-link text-decoration-none text-dark" @click="filterPostsByPrice(index-1)">
                                        ${{ new Intl.NumberFormat().format(minPriceRanges[index-1]) }} a ${{ new Intl.NumberFormat().format( maxPriceRanges[index-1]) }}
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
                <input class="form-control" type="text" id="búsqueda" v-model="filters.keyWord" placeholder="Búsqueda" @keyup="searchPosts(filters.keyWord)" >
                <hr>
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
                                    <p v-if="product.sold" class="text-success">Vendida</p>
                                    <p v-if="product.apartada" style="color: rgb(255, 166, 0);">Apartada</p>
                                    <p v-if="product.color" class="card-text text-body"><i>{{ product.color }}</i></p>
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
            years: [],
            minKmRanges: [0, 5001, 10001, 15001, 20001, 25001],
            maxKmRanges: [5000, 10000, 15000, 20000, 25000, 30000],
            minPriceRanges: [0, 50001, 100001, 150001, 200001, 250001],
            maxPriceRanges: [50000, 100000, 150000, 200000, 250000, 500000],
            selectedFiltersName: [],
            filterPriceIndex: 0,
            filterKmIndex: 0,
            filters: [
                {'brand_id': [],
                'version_id': [],
                'model_id': [],
                'year': 0,
                'keyWord': '',
                'minKmRange': null,
                'maxKmRange': null,
                'minPriceRange': null,
                'maxPriceRange': null,
            },
            ]
        }
    },
    mounted() {
        this.getProducts();
        this.getBrands();
        this.getVersions();
        this.getModels();
        this.getYears();
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
            }).catch( e => console.error('Error brands ->',e));
        },
        getVersions: function (){
            axios.get('api/version')
                .then( (response) =>{
                   this.versions = response.data;
                });
        },
        getModels: function (){
            axios.get('api/model/onSale')
                .then( (response) =>{
                    this.models = response.data;
                });
        },
        getYears: function (){
            for (var i = 2015; i <= (new Date().getFullYear()); i++) {
                this.years.push(i);
            }
        },
        filterPostsByKM: function(index){
            this.filterKmIndex = index;
            this.filters[0].minKmRange = this.minKmRanges[index];
            this.filters[0].maxKmRange = this.maxKmRanges[index];
            let description = this.minKmRanges[index] + ' - ' + this.maxKmRanges[index]+' km';
            let kms = { km_id:index, description};
            
            for (let i = 0; i < this.selectedFiltersName.length; i++) {
                if ('km_id' in this.selectedFiltersName[i]) {
                    this.selectedFiltersName.splice(i,1);
                }                
            }

            this.selectedFiltersName.push(kms);
            this.sendingFilterRequest();
        
        },
        filterPostsByPrice: function(index){
            this.filterPriceIndex = index;
            this.filters[0].minPriceRange = this.minPriceRanges[index];
            this.filters[0].maxPriceRange = this.maxPriceRanges[index];       
            
            let description = '$' + this.minPriceRanges[index] + ' - $' + this.maxPriceRanges[index];
            let prices = { price_id:index, description};

            for (let i = 0; i < this.selectedFiltersName.length; i++) {
                if ('price_id' in this.selectedFiltersName[i]) {
                    this.selectedFiltersName.splice(i,1);
                } 
            }
            this.selectedFiltersName.push(prices);
            this.sendingFilterRequest();

            /* this.selectedFiltersName.forEach((filtro, i) => {
                if ('price_id' in filtro) {
                    this.selectedFiltersName[i].price_id = index;
                    this.selectedFiltersName[i].description = description;

                    this.sendingFilterRequest();  
                } else {
                    this.selectedFiltersName.push(prices);
                    this.sendingFilterRequest();
                }
                
            });   */ 

        },
        filterPostsByBrand: function (brand){
            this.filters[0]['brand_id'].push(brand.id)
            this.selectedFiltersName.push(brand);
            console.info("Haciendo el filtro con brand_id: "+brand.id);
            this.sendingFilterRequest();
        },
        filterPostsByVersion: function (version){
            this.filters[0]['version_id'].push(version.id);
            this.selectedFiltersName.push(version);
            console.info("Haciendo el filtro con version_id: "+version.id);
            this.sendingFilterRequest();
        },
        filterPostsByModel: function (model){
            this.filters[0]['model_id'].push(model.id);
            console.info("Haciendo el filtro con model_id: "+model.id);
            this.selectedFiltersName.push(model);
            this.sendingFilterRequest();
        },   
        filterPostsByYear: function (year){
            this.filters[0]['year'] = year;
            console.info("Haciendo el filtro con year: "+year);
            this.selectedFiltersName.push(year);
            this.sendingFilterRequest();
        },      
        searchPosts: function (keyWord){
            this.filters[0]['keyWord'] = keyWord;
            //console.info("Haciendo búsqueda con: "+keyWord);
            //this.selectedFiltersName.push(model);
            if (!keyWord) {
                //console.log("sin Keyword", keyWord)
                this.getProducts();
            } else {
                //console.log("Keyword para búsqueda: ", keyWord)
                this.sendSearchRequest();                
            }
        },
        sendingFilterRequest: function(){
            axios({
                url: 'api/product/filter',
                method: 'POST',
                data: {
                    filters: this.filters
                }
            }).then( (response) => {
                this.products = [];
                this.products = response.data;
            }).catch(e=>console.error(e));
        },
        sendSearchRequest: function(){
            //console.log(this.filters);
            axios({
                url: 'api/product/searchByWord',
                method: 'POST',
                data: {
                    filters: this.filters
                }
            }).then( (response) => {
                this.products = [];
                // elimina vendidos
                response.data.forEach(element => {
                    if (element.sold) {
                        response.data.pop();
                    }
                });
                this.products = response.data;
            }).catch( err => console.error(err));
        },
        removingFilter: function(type, filter){
            console.info("Tipo de filtro a borrar: "+type);
            console.info("Indice del elemento: "+this.selectedFiltersName.indexOf(filter));
            switch (type){
                case 'brand':
                    this.filters[0]['brand_id'].splice(this.selectedFiltersName.indexOf(filter), 1);
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
                case 'version':
                    this.filters[0]['version_id'].splice(this.selectedFiltersName.indexOf(filter), 1);
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
                case 'model':
                    this.filters[0]['model_id'].splice(this.selectedFiltersName.indexOf(filter), 1);
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
                case 'km':
                    this.filters[0]['minKmRange'] = 0;
                    this.filters[0]['maxKmRange'] = 99999999;
                    this.selectedFiltersName.splice(this.selectedFiltersName.indexOf(filter), 1)
                    this.sendingFilterRequest();
                    break;
                case 'price':
                    this.filters[0]['minPriceRange'] = 0;
                    this.filters[0]['maxPriceRange'] = 99999999;
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