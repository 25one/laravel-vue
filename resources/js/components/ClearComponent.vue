<template>
        <div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
            <div class="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                <div class="button button_clear trans_200" @click="clearCart"><a href="#">clear</a></div>
            </div>                                        
        </div> 
</template>

<script>
    import axios from 'axios';
    import {EventBus} from '../event-bus';

    export default {
        data: function() {
           return {
              //...
           }
        },
        mounted() {
           //...
        },
        methods: { 
           clearCart() {
             event.preventDefault();

             let app = this; //!!!app - becouse axios
             axios
              .post('/clearall', {})
                .then(function (resp) {
                    console.log(resp.data);
                    //app.carts = resp.data; //!!!app - becouse axios
                    EventBus.$emit('carts-after-remove', { //!!!
                       cartsAfterRemove: resp.data,
                    });	                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not clear cart");
                });       
           }, 
        },
    }
</script>
