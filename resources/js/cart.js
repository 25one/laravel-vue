window.Vue = require('vue');

import CartComponent from './components/CartComponent.vue'; //!!!

const app = new Vue({
    el: '.cart_block', //+ in cart.blade.php <div id="app"> вместо <div class="cart_items">(ul + include)
    components: { CartComponent },
    template: '<CartComponent />' 
});

