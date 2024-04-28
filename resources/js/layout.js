window.Vue = require('vue');

import LayoutComponent from './components/LayoutComponent.vue'; //!!!

const app = new Vue({
    el: '.newsletter',
    components: { LayoutComponent },
    template: '<LayoutComponent />' 
});

