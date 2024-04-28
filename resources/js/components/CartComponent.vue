<template>
    <div>
        <div class="cart_items">
           <ul class="cart_items_list">
                <!-- Cart Item -->                                  
                <li v-for="cart, index in carts" class="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-end justify-content-start" style="width: 50%;">
                    <div class="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start mr-auto">
                        <RemoveComponent :cartId="cart.id" />
                        <div><div class="product_image"><img :src="'images/'+cart.product.image" alt=""></div></div>
                        <div class="product_name_container">
                            <div class="product_name"><a href="#">{{cart.product.name}}</a></div>
                            <div class="product_text">Second line for additional info</div>
                        </div>
                    </div>
                    <div class="product_price product_text">{{cart.product.price}}</div>
                    <div class="product_price product_text">{{cart.size.name}}</div>
                </li>
               <!-- Cart Item -->
           </ul>
        </div> 
        <ClearComponent /> 
    </div>             
</template>

<script>
    import axios from 'axios';
    import RemoveComponent from '../components/RemoveComponent.vue';
    import ClearComponent from '../components/ClearComponent.vue';
    import {EventBus} from '../event-bus';
    import {objCartNative} from '../cartCountChange';

    export default {
        data: function() {
           return {
              carts: window.carts
           }
        },
        components: { //!!!
           RemoveComponent,
           ClearComponent
        },        
        mounted() {
           //console.log(window.carts);

           EventBus.$on('carts-after-remove', data => { //!!!
               console.log('Custom event triggered!');
               this.carts = data.cartsAfterRemove;

               objCartNative.countChange(data.cartsAfterRemove.length);
           });            
        },
        methods: { 
           //...
        },
    }
</script>
