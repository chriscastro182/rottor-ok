<template>
    <div id="model-brand-relation">
        <div class="form-group">
            <label for="brand_id">{{ brand_title }}</label>
            <select id="brand_id"  class="form-control" name="brand_id" v-model="brand_selected">
                <option value="">.: Selecciona :.</option>
                <option v-for="brand in brands" :value="brand.id" >{{ brand.name }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="model_id">{{ model_title }}</label>
            <select id="model_id" class="form-control" name="model_id" v-model="model_selected">
                <option value="">.: Selecciona :.</option>
                <option v-for="model in models" :value="model.id">{{ model.description }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="version_id">{{ version_title }}</label>
            <select id="version_id" class="form-control" name="version_id">
                <option value="">.: Selecciona :.</option>
                <option v-for="version in versions" :value="version.id">{{ version.name }}</option>
            </select>
        </div>
    </div>
</template>

<script charset="utf-8">
import axios from "axios";

export default {
    name: "ProductBrandModelComponent",
    data(){
        return {
            brand_title: 'Marca',
            model_title: 'Modelo',
            version_title: 'Versión',
            brand_selected: '',
            model_selected: '',
            models: [],
            brands: [],
            versions: []
        }
    },
    created() {
        this.getBrands();
    },
    watch:{
        brand_selected: function(newValue, oldValue){
            console.info('nuevo valor: '+newValue);
            this.getModels(newValue);
        },
        model_selected: function(newValue, oldValue){
            this.getVersions(newValue);
        }
    },
    methods: {
        getBrands: function(){
            axios({
                method : 'GET',
                url: '/admin/brands/allForm',
            }).then( (response) => {
                this.brands = response.data;
            });
        },
        getModels: function(brand_id){
            axios({
                method : 'GET',
                url: '/admin/brands/'+brand_id+'/models/allForm',
            }).then( (response) => {
                this.models = response.data;
            });
        },
        getVersions: function(model_id){
            axios({
                method: 'GET',
                url: '/admin/models/'+model_id+'/versions/allForm',
            }).then( (response) => {
                this.versions = response.data;
            });
        },
        brandSelected: function(value){
            console.info(value);
        }
    }
}
</script>

<style scoped>

</style>
