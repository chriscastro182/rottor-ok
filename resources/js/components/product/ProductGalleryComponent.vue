<template>
    <div>
        <lingallery :iid.sync="currentId" :width="width" :height="height" :items="images"></lingallery>
    </div>
</template>

<script charset="utf-8">
import axios from "axios";
import LinGallery from 'lingallery';

export default {
    name: "ProductGalleryComponent",
    data(){
        return {
            startingImage: 1,
            images: [],
            width: 600,
            height: 400,
            currentId: null
        }
    },
    props: ['product_id'],
    components: {
        LinGallery
    },
    created() {
        this.getProductImages();
    },
    methods: {
        getProductImages: function(){
            axios({
                method: 'GET',
                url: '/api/product/'+this.product_id+'/images'
            }).then( (response) => {
                console.info(response);
                if (response.data.status){
                    var imagenes = [];
                    response.data.images.map(function(value, key){
                        console.info(value);
                        imagenes.push({
                            src: value.url,
                            thumbnail: value.url,
                            id: value.id
                        });
                    });
                    this.images = imagenes;
                }
            });
        }
    }
}
</script>

<style scoped>

</style>