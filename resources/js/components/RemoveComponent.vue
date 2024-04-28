<template>
   <div>
      <a class="btn btn-danger listbuttonremove" :id="cartId" href="#" @click="removeCart"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
   </div> 
</template>

<script>
    import axios from 'axios';
    import {EventBus} from '../event-bus';

    export default {
        props: ['cartId'],
        data: function() {
           return {
              //...
           }
        },
        mounted() {
           //...
        },
        methods: { 
           //removeCart(id) {
           removeCart(event) { 
             let id = event.currentTarget.id;

             event.preventDefault();

             let app = this; //!!!app - becouse axios
             axios
              .post('/clearone', {id: id})
                .then(function (resp) {
                    console.log(resp.data);
                    //app.carts = resp.data; //!!!app - becouse axios
                    EventBus.$emit('carts-after-remove', { //!!!
                       cartsAfterRemove: resp.data,
                    });	                    
                })
                .catch(function (resp) {
                    console.log(resp.response);
                    //alert("Could not delete cart");
                    alert(resp.response.data.message); 
                });      
           }, 
        },
    }
</script>
